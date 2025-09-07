@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Booking Confirmed!</h1>
    <p class="text-gray-600 mb-6">{{ session('message') }}</p>
    <div class="flex justify-center space-x-4">
        <a href="{{ route('book') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Make Another Booking
        </a>
        @auth
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                View My Bookings
            </a>
        @endauth
    </div>
</div>
@endsection