
<div style="background-image: url('/smallw.png')" class="min-h-screen flex items-center justify-center bg-cover bg-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full bg-white/50 shadow-lg rounded-lg p-8">
        <!-- Step Indicator -->
        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
            @for($i = 1; $i <= 3; $i++)
                <div class="flex items-center sm:flex-1">
                    <span class="inline-block w-8 h-8 rounded-full {{ $step >= $i ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }} flex items-center justify-center mr-3 flex-shrink-0">
                        {{ $i }}
                    </span>
                    <p class="text-sm font-bold">
                        {{ $i === 1 ? 'Locations & Date' : ($i === 2 ? 'Details' : 'Review') }}
                    </p>
                </div>
            @endfor
        </div>

        <div wire:loading wire:target="submit,nextStep,previousStep" class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
            <div class="text-center">
                <svg class="animate-spin h-10 w-10 text-blue-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <p class="text-blue-600 font-semibold text-lg">Processing, please wait...</p>
            </div>
        </div>

        <!-- Form Content -->
        <form wire:submit.prevent="submit" class="space-y-6">
            @if($step === 1)
                <h2 class="text-2xl font-bold text-gray-900">Step 1: Locations and Date/Time</h2>
                <div>
                    <label for="pickup_location" class="block text-sm font-medium text-gray-700">Pickup Location *</label>
                    <input type="text" wire:model="pickup_location" id="pickup_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Enter pickup location">
                    @error('pickup_location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="dropoff_location" class="block text-sm font-medium text-gray-700">Dropoff Location *</label>
                    <input type="text" wire:model="dropoff_location" id="dropoff_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Enter dropoff location">
                    @error('dropoff_location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="pickup_datetime" class="block text-sm font-medium text-gray-700">Pickup Date & Time *</label>
                    <input type="datetime-local" wire:model="pickup_datetime" id="pickup_datetime" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <button type="button"
                            wire:click="$refresh" 
                            class="hidden md:inline-block mt-2 px-3 py-1 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600">
                        Set
                    </button>
                    @error('pickup_datetime') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <p><strong>Distance:</strong> {{ $distanceText ?: 'Add Pickup & Dropoff to calculate distance...' }}</p>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Trip Type</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <label for="point_to_point" class="inline-flex items-center">
                            <input 
                                type="radio" 
                                wire:model="trip_type" 
                                id="point_to_point" 
                                name="trip_type" 
                                value="1" 
                                class="form-radio text-blue-500 focus:ring-blue-500" 
                                required
                                {{ $trip_type ? 'checked' : '' }}
                            >
                            <span class="ml-2 text-sm">Point to Point</span>
                        </label>
                        <label for="hourly" class="inline-flex items-center">
                            <input 
                                type="radio" 
                                wire:model="trip_type" 
                                id="hourly" 
                                name="trip_type" 
                                value="0" 
                                class="form-radio text-blue-500 focus:ring-blue-500" 
                                required
                                {{ !$trip_type ? 'checked' : '' }}
                            >
                            <span class="ml-2 text-sm">Hourly</span>
                        </label>
                    </div>
                    @error('trip_type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="nextStep" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Next
                    </button>
                </div>
            @elseif($step === 2)
                <h2 class="text-2xl font-bold text-gray-900">Step 2: Details</h2>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                    <input type="tel" wire:model="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="e.g., (123) 456-7890" maxlength="14" required>
                    @error('phone') 
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="passengers" class="block text-sm font-medium text-gray-700">Passengers</label>
                    <input type="number" wire:model="passengers" id="passengers" min="1" max="100" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Number of passengers">
                    @error('passengers') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="luggage" class="block text-sm font-medium text-gray-700">Luggage</label>
                    <input type="number" wire:model="luggage" id="luggage" min="0" max="50" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Number of luggage items">
                    @error('luggage') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                @if(!$trip_type)
                    <div>
                        <label for="estimated_hours" class="block text-sm font-medium text-gray-700">Required Hours</label>
                        <input type="number" wire:model="estimated_hours" id="estimated_hours" min="1" max="24" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Estimated hours (optional)">
                        @error('estimated_hours') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Vehicle *</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                            @foreach($vehicles as $vehicle)
                                <div wire:click="$set('vehicle_id', {{ $vehicle->id }})"
                                    class="cursor-pointer p-4 border {{ $vehicle_id == $vehicle->id ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }} rounded-md">
                                    <img src="{{ asset('storage/'.$vehicle->image) }}" class="h-24 w-auto rounded-md mb-2">
                                    <p class="font-medium">{{ $vehicle->name }} ({{ $vehicle->type }})</p>
                                    <p class="text-sm text-gray-600">Capacity: {{ $vehicle->passenger_capacity }} passengers / {{ $vehicle->luggage_capacity }} luggage</p>
                                </div>
                            @endforeach
                        </div>
                        @error('vehicle_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- NEW: Required Vehicles --}}
                    @if($vehicle_id)
                        <div class="mt-4 p-4 border rounded bg-gray-100">
                            <h3 class="font-semibold text-lg">Selected Vehicle</h3>
                            <p>{{ $vehicles->find($vehicle_id)->name ?? 'Vehicle' }} × {{ $vehicle_count ?? 1 }}</p>

                            @if($trip_type)
                                <p>Distance: {{ number_format($distanceInMiles, 2) }} miles</p>
                                <p class="font-bold">Total Price: ${{ number_format($total_price, 2) }}</p>
                            @else
                                <p>Estimated Hours: {{ $estimated_hours ?: ceil($durationInMinutes / 60) }}</p>
                                <p class="font-bold">Total Price: ${{ number_format($total_price, 2) }}</p>
                            @endif
                        </div>
                    @endif

                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="with_pet" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Traveling with Pet?</span>
                    </label>
                    @error('with_pet') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                {{-- <!-- <div>
                    <label for="iatan_account" class="block text-sm font-medium text-gray-700">IATAN # / Account # (Optional)</label>
                    <input type="text" wire:model="iatan_account" id="iatan_account" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="IATAN or account number">
                    @error('iatan_account') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="ta_fee" class="block text-sm font-medium text-gray-700">TA Fee USD (Optional)</label>
                    <input type="number" wire:model="ta_fee" id="ta_fee" min="0" max="1000" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="TA fee in USD">
                    @error('ta_fee') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div> --> --}}
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea wire:model="notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Additional notes"></textarea>
                    @error('notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-between">
                    <button type="button" wire:click="previousStep" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Back
                    </button>
                    <button type="button" wire:click="nextStep" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Next
                    </button>
                </div>
            @elseif($step === 3)
                <h2 class="text-2xl font-bold text-gray-900">Step 3: Review and Confirm</h2>
                @php
                    $vehicle = $vehicles->find($vehicle_id);
                    $capacity = $vehicle?->passenger_capacity ?? 1;
                    $reqVehicles = ceil($passengers / max(1,$capacity));
                @endphp
                <div class="space-y-4">
                    <p><strong>Pickup:</strong> {{ $pickup_location }} at {{ $pickup_datetime }}</p>
                    <p><strong>Dropoff:</strong> {{ $dropoff_location }}</p>
                    <p><strong>Distance:</strong> {{ $distanceText ?: 'Calculating...' }}</p> <!-- New: Show distance -->
                    <p><strong>Phone:</strong> {{ $phone ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phone) : 'N/A' }}</p>
                    <p><strong>Passengers:</strong> {{ $passengers }}</p>
                    <p><strong>Luggage:</strong> {{ $luggage }}</p>
                    <p><strong>Travel Type:</strong> {{ $trip_type ? 'Point to Point' : 'Hourly' }}</p>
                    @if(!$trip_type && !empty($estimated_hours))
                        <p><strong>Required Hours:</strong> {{ $estimated_hours }}</p>
                    @endif
                    <p><strong>Total Price:</strong> ${{ number_format($total_price, 2) }}</p>
                    {{-- <!-- <p><strong>Vehicle:</strong> {{ $vehicles->find($vehicle_id)->name ?? 'Not selected' }}</p> --> --}}
                    <p><strong>Vehicle:</strong> {{ $vehicle?->name }} × {{ $reqVehicles }}</p>
                    @if($vehicle_id)
                        <img src="{{ asset('storage/' . $vehicles->find($vehicle_id)->image) }}" alt="{{ $vehicles->find($vehicle_id)->name }}" class="h-24 w-auto rounded-md">
                    @endif
                    <p><strong>With Pet:</strong> {{ $with_pet ? 'Yes' : 'No' }}</p>
                    {{-- <!-- <p><strong>IATAN/Account:</strong> {{ $iatan_account ?? 'N/A' }}</p> --> --}}
                    {{-- <!-- <p><strong>TA Fee:</strong> ${{ $ta_fee ?? 'N/A' }}</p> --> --}}
                    <p><strong>Notes:</strong> {{ $notes ?? 'None' }}</p>
                    @if(!auth()->check())
                        <div>
                            <p class="text-sm text-gray-600">Optional: <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> or <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Signup</a> to save this booking to your account.</p>
                            <label for="guest_email" class="block text-sm font-medium text-gray-700">Your Email (for confirmation)</label>
                            <input type="email" wire:model="guest_email" id="guest_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Your email" required>
                            @error('guest_email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" wire:click="previousStep" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Back
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Confirm Booking
                    </button>
                </div>
            @endif
        </form>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pickupInput = document.getElementById('pickup_location');
                const dropoffInput = document.getElementById('dropoff_location');

                if (pickupInput && dropoffInput) {
                    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, {
                        types: ['geocode'],
                        componentRestrictions: { country: 'us' }
                    });
                    const dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput, {
                        types: ['geocode'],
                        componentRestrictions: { country: 'us' }
                    });

                    // Allowed cities with coordinates + radius (50 km)
                    const allowedCities = [
                        { name: "Dallas", lat: 32.7767, lng: -96.7970, radius: 70000 }, // 70 km
                        { name: "Chicago", lat: 41.8781, lng: -87.6298, radius: 70000 },
                        { name: "Houston", lat: 29.7604, lng: -95.3698, radius: 70000 }
                    ];

                    // Haversine formula for distance in meters
                    function getDistance(lat1, lng1, lat2, lng2) {
                        const R = 6371e3; // Earth radius (meters)
                        const toRad = deg => deg * Math.PI / 180;
                        const dLat = toRad(lat2 - lat1);
                        const dLng = toRad(lng2 - lng1);
                        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                                Math.sin(dLng / 2) * Math.sin(dLng / 2);
                        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                        return R * c; // in meters
                    }

                    pickupAutocomplete.addListener('place_changed', function() {
                        const place = pickupAutocomplete.getPlace();
                        if (!place.geometry) {
                            return;
                        }

                        const lat = place.geometry.location.lat();
                        const lng = place.geometry.location.lng();

                        // Check against allowed cities
                        let valid = false;
                        let nearestCity = null;

                        for (let city of allowedCities) {
                            const distance = getDistance(lat, lng, city.lat, city.lng);
                            if (distance <= city.radius) {
                                valid = true;
                                nearestCity = city.name;
                                break;
                            }
                        }

                        if (!valid) {
                            pickupInput.value = '';
                            alert(`Currently we provide pickup only within Chicago, Houston and Dallas TX. Please select a valid address.`);
                            return;
                        }

                        // update Livewire
                        const component = Livewire.find(pickupInput.closest('[wire\\:id]').getAttribute('wire:id'));
                        if (component) {
                            component.set('pickup_location', place.formatted_address || pickupInput.value);
                        }
                        calculateDistance();
                    });

                    dropoffAutocomplete.addListener('place_changed', function() {
                        const place = dropoffAutocomplete.getPlace();
                        const component = Livewire.find(dropoffInput.closest('[wire\\:id]').getAttribute('wire:id'));
                        if (component){
                            component.set('dropoff_location', place.formatted_address || dropoffInput.value);
                        }
                        calculateDistance();
                    });
                }

                function calculateDistance() {
                    const pickup = document.getElementById('pickup_location').value;
                    const dropoff = document.getElementById('dropoff_location').value;

                    if (pickup && dropoff) {
                        const service = new google.maps.DistanceMatrixService();

                        service.getDistanceMatrix({
                            origins: [pickup],
                            destinations: [dropoff],
                            travelMode: 'DRIVING',
                            unitSystem: google.maps.UnitSystem.IMPERIAL,
                        }, function(response, status) {
                            if (status === 'OK') {
                                const result = response.rows[0].elements[0];

                                const distanceText = result.distance.text;
                                const durationText = result.duration.text;

                                const distanceInMiles = parseFloat(result.distance.value / 1609.34);
                                const durationInMinutes = parseInt(result.duration.value / 60);

                                const distanceDisplay = `${distanceText}, ${durationText}`;

                                const component = Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));
                                if (component) {
                                    component.call('updateDistance', {
                                        text: distanceDisplay,
                                        miles: distanceInMiles,
                                        duration: durationInMinutes
                                    });
                                }
                            } else {
                                console.error('Distance Matrix error: ' + status);
                            }
                        });
                    }
                }
            });
        </script>
        
        <script>
            document.addEventListener('livewire:init', () => {
                // Function to check and focus on phone error
                function checkAndFocusPhoneError() {
                    const phoneInput = document.getElementById('phone');
                    const phoneErrorSpan = phoneInput ? phoneInput.parentElement.querySelector('.text-red-600') : null;
                    if (phoneInput && phoneErrorSpan && phoneErrorSpan.textContent.trim() !== '') {
                        phoneInput.focus();
                        phoneInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }

                // Check on initial load
                checkAndFocusPhoneError();

                // Listen for Livewire updates (after validation re-renders)
                Livewire.hook('morph.updated', () => {
                    checkAndFocusPhoneError();
                });
            });

            // Phone input masking and limiting to 10 digits
            document.addEventListener('DOMContentLoaded', () => {
                const phoneInput = document.getElementById('phone');
                if (phoneInput) {
                    phoneInput.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                        if (value.length > 10) value = value.slice(0, 10); // Limit to 10 digits

                        // Format as (XXX) XXX-XXXX
                        let formattedValue = '';
                        if (value.length >= 7) {
                            formattedValue = `(${value.slice(0,3)}) ${value.slice(3,6)}-${value.slice(6,10)}`;
                        } else if (value.length >= 4) {
                            formattedValue = `(${value.slice(0,3)}) ${value.slice(3)}`;
                        } else {
                            formattedValue = value;
                        }

                        e.target.value = formattedValue;

                        // Update Livewire with clean digits
                        Livewire.dispatchTo('booking-wizard', 'updatePhone', { phone: value });
                    });
                }
            });
        </script>
    </div>
</div>