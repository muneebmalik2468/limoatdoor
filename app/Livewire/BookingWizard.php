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
    public $vehicle_count = 1;
    public $requiredVehicles = 1;


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

        // Recalculate whenever passengers/luggage change
        if (in_array($propertyName, ['passengers','luggage','vehicle_id'])) {
            $this->calculatePricing();
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


    public function updateDistance($data)
    {
        if (!is_array($data)) {
            return;
        }

        $this->distanceText = $data['text'] ?? '';
        $this->distanceInMiles = $data['miles'] ?? 0;
        $this->durationInMinutes = $data['duration'] ?? 0;

        $this->calculatePricing();
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
            $this->vehicle_count = 1;
            $this->calculated_distance_price = 0;
            $this->calculated_time_price = 0;
            $this->total_price = 0;
            return;
        }

        // Determine required quantity
        $passengerCapacity = data_get($vehicle, 'passenger_capacity') 
            ?? data_get($vehicle, 'capacity') 
            ?? 1;
        $luggageCapacity = data_get($vehicle, 'luggage_capacity') 
            ?? data_get($vehicle, 'luggage_limit') 
            ?? 1;

        // safety: avoid divide by zero
        $passengerUnits = $passengerCapacity > 0 ? (int) ceil($this->passengers / $passengerCapacity) : 1;
        $luggageUnits   = $luggageCapacity > 0 ? (int) ceil(max(0, $this->luggage) / $luggageCapacity) : 1;

        // how many vehicles needed
        $this->vehicle_count = max(1, $passengerUnits, $luggageUnits);

        // Distance or hourly fare
        if ($this->trip_type) {
            // price PER vehicle
            // $perVehicleDistancePrice = round($vehicle->base_rate * $this->distanceInMiles, 2);

            // Distance-based trip
            if ($this->distanceInMiles <= 10) {
                // Use fixed rate if distance is <= 10 miles
                $perVehicleDistancePrice = round($vehicle->fixed_rate, 2);
            } else {
                // Use normal per-mile rate for >10 miles
                $perVehicleDistancePrice = round($vehicle->base_rate * $this->distanceInMiles, 2);
            }

            // multiply by vehicle_count
            $this->calculated_distance_price = round($perVehicleDistancePrice * $this->vehicle_count, 2);
            $this->calculated_time_price = 0;
            $this->total_price = $this->calculated_distance_price;
        } else {
            // Use round to calculate exact time
            // $hours = round($this->durationInMinutes / 60, 2);
            // Use ceil to always round UP to the next full hour
            // $hours = ceil($this->durationInMinutes / 60);

            // Base calculated hours (rounded UP)
            $calculatedHours = ceil($this->durationInMinutes / 60);

            // If user provided estimated_hours and it's greater, use that
            if (!empty($this->estimated_hours) && $this->estimated_hours > $calculatedHours) {
                $hours = (int) ceil($this->estimated_hours);
            } else {
                $hours = $calculatedHours;
            }
            $perVehicleHourly = round($vehicle->hourly_rate * $hours, 2);
            $this->calculated_time_price = round($perVehicleHourly * $this->vehicle_count, 2);
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

        $price = round($this->total_price, 2);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'pickup_location' => $this->pickup_location,
            'dropoff_location' => $this->dropoff_location,
            'pickup_datetime' => $this->pickup_datetime,
            'passengers' => $this->passengers,
            'luggage' => $this->luggage,
            'vehicle_id' => $this->vehicle_id,
            'vehicle_count'     => $this->vehicle_count,
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
            'price' => $price,
        ]);

        try {
            Mail::to(config('mail.admin_email'))->send(new BookingNotification($booking));
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