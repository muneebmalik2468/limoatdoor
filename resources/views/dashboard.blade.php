@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Your Bookings</h1>

    @if (session('message'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (Auth::user()->bookings->isEmpty())
        <p class="text-gray-600">You have no bookings yet. <a href="{{ route('book') }}" class="text-blue-600 hover:underline">Book now!</a></p>
    @else
        <!-- Static Note -->
        <div class="mb-6 p-4 bg-yellow-100 text-yellow-800 rounded-md border border-yellow-300">
            <strong>Note:</strong> You can cancel your booking within 8 hours after making the booking.
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dropoff</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fare</th>
                        <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle Image</th> -->
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passengers</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach (Auth::user()->bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->pickup_location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->dropoff_location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->pickup_datetime->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->vehicle->name ?? 'N/A' }}</td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->vehicle && $booking->vehicle->image)
                                    <img src="{{ asset('storage/' . $booking->vehicle->image) }}" alt="{{ $booking->vehicle->name }}" class="h-16 w-auto rounded-md">
                                @else
                                    <span class="text-gray-600">No Image</span>
                                @endif
                            </td> -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ $booking->price }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->passengers }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ 
                                        $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                        ($booking->status === 'confirmed' ? 'bg-green-100 text-green-800' :
                                        ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) 
                                    }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($booking->status === 'pending')
                                    @php
                                        $canCancel = $booking->created_at->gt(now()->subHours(8));
                                    @endphp

                                    @if($canCancel)
                                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Cancel</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Cancellation time expired</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection