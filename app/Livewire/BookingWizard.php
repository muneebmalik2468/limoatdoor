<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Mail\BookingNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingWizard extends Component
{
    protected $listeners = ['updateDistance'];

    public $step = 1;
    public $pickup_location = '';
    public $dropoff_location = '';
    public $pickup_datetime = '';
    public $passengers = 1;
    public $luggage = 0;
    public $vehicle_id = '';
    public $estimated_hours = null;
    public $iatan_account = '';
    public $ta_fee = null;
    public $with_pet = false;
    public $notes = '';
    public $guest_email = '';
    public $phone = '';
    public $distanceText = '';
    public $distanceInMiles = 0;
    public $durationInMinutes = 0;
    public $calculated_distance_price = 0;
    public $calculated_time_price = 0;
    public $vehicles;
    public $trip_type = true;
    public $total_price = 0.00;


    protected function rules()
    {
        return [
            1 => [
                'pickup_location' => 'required|string|max:255',
                'dropoff_location' => 'required|string|max:255',
                'pickup_datetime' => 'required|date|after:now',
                'trip_type' => 'required|boolean',
            ],
            2 => [
                'passengers' => 'required|integer|min:1',
                'luggage' => 'required|integer|min:0',
                'vehicle_id' => 'required|exists:vehicles,id',
                'estimated_hours' => 'nullable|integer|min:1',
                'with_pet' => 'boolean',
                'iatan_account' => 'nullable|string|max:255',
                'ta_fee' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
                'phone' => 'required|string|regex:/^(\+?1[-.\s]?)?\(?[0-9]{3}\)?[-.\s]?[0-9]{3}[-.\s]?[0-9]{4}$/',
            ],
            3 => [
                'guest_email' => ['email', function ($attribute, $value, $fail) {
                    if (!Auth::check() && empty($value)) {
                        $fail('The guest email is required when you are not logged in.');
                    }
                }],
            ],
        ];
    }

    public function mount()
    {
        $this->vehicles = Vehicle::where('is_available', true)->get();
    }

    public function updatedTripType($value)
    {
        $this->trip_type = $value === '1' ? true : false;
        $this->calculatePricing();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'trip_type') {
            $this->validateOnly('trip_type', $this->rules()[1]);
        }
        if ($this->step === 3 && $propertyName === 'guest_email') {
            $this->validateOnly($propertyName, $this->rules()[3]);
        }
    }

    public function updatePhone($phone)
    {
        $this->phone = $phone;
    }

    public function nextStep()
    {
        $this->validate($this->rules()[$this->step]);
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    // public function updateDistance($distance)
    // {
    //     $this->distanceText = $distance; // Update from JS dispatch
    // }
    public function updateDistance($data)
    {
        if (!is_array($data)) {
            return; // or handle fallback
        }

        $this->distanceText = $data['text'] ?? '';
        $this->distanceInMiles = $data['miles'] ?? 0;
        $this->durationInMinutes = $data['duration'] ?? 0;

        $this->calculatePricing(); // Optional
    }


    public function updatedVehicleId($value)
    {
        $this->calculatePricing();
    }

    public function updatedEstimatedHours($value)
    {
        if (!$this->trip_type) {
            $this->calculatePricing();
        }
    }

    public function calculatePricing()
    {
        $vehicle = $this->vehicles->find($this->vehicle_id);
        if (!$vehicle) {
            $this->calculated_distance_price = 0;
            $this->calculated_time_price = 0;
            $this->total_price = 0;
            return;
        }

        if ($this->trip_type) {
            $this->calculated_distance_price = round($vehicle->base_rate * $this->distanceInMiles, 2);
            $this->calculated_time_price = 0;
            $this->total_price = $this->calculated_distance_price;
        } else {
            $hours = round($this->durationInMinutes / 60, 2);
            $this->calculated_time_price = round($vehicle->hourly_rate * $hours, 2);
            $this->calculated_distance_price = 0;
            $this->total_price = $this->calculated_time_price;
        }
    }

    public function updatedDistanceInMiles()
    {
        $this->calculatePricing();
    }

    // public function updatedDurationInMinutes() { $this->calculatePricing(); }


    public function submit()
    {
        $this->validate(array_merge(...array_values($this->rules())));

        $price = $this->trip_type
        ? $this->calculated_distance_price
        : $this->calculated_time_price;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'pickup_location' => $this->pickup_location,
            'dropoff_location' => $this->dropoff_location,
            'pickup_datetime' => $this->pickup_datetime,
            'passengers' => $this->passengers,
            'luggage' => $this->luggage,
            'vehicle_id' => $this->vehicle_id,
            'estimated_hours' => $this->estimated_hours,
            'iatan_account' => $this->iatan_account,
            'ta_fee' => $this->ta_fee,
            'with_pet' => $this->with_pet,
            'notes' => $this->notes,
            'guest_email' => Auth::check() ? null : $this->guest_email,
            'phone' => $this->phone,
            'trip_type' => $this->trip_type,
            'distance_in_miles' => round($this->distanceInMiles, 2),
            'duration_in_minutes' => $this->durationInMinutes,
            'price' => round($price, 2),
        ]);

        try {
            Mail::to(env('ADMIN_EMAIL'))->send(new BookingNotification($booking));
        } catch (\Exception $e) {
            Log::error('Failed to send booking notification: ' . $e->getMessage());
        }

        $userEmail = $booking->user ? $booking->user->email : $booking->guest_email;
        if ($userEmail) {
            try {
                Mail::to($userEmail)->send(new BookingNotification($booking));
                Log::info('User email sent successfully to ' . $userEmail . ' for booking ID: ' . $booking->id);
            } catch (\Exception $e) {
                Log::error('Failed to send user booking notification to ' . $userEmail . ': ' . $e->getMessage());
            }
        } else {
            Log::warning('No user email available for booking ID: ' . $booking->id);
        }

        session()->flash('message', 'Booking created!');
        return redirect()->route('bookings.success');
    }

    public function render()
    {
        return view('livewire.booking-wizard');
    }
}