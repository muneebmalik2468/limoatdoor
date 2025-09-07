<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="description" content="{{ $metaDescription ?? 'Book luxury rides in minutes. Safe, reliable, and fast.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'book a ride, car service, airport pickup, limo service' }}">
    <meta name="author" content="Limo At Door">

    <title>Limo At Door</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('limoatdoorfav.png') }}" type="image/png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        @include('layouts.navigation')
        <!-- Hero Section -->
        <section class="bg-gray-100 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">Global Chauffeur & Travel Services</h1>
                <p class="mt-4 text-lg text-gray-600">Book your luxury ride in over 1,000 cities worldwide with ease and comfort.</p>
                <a href="{{ route('book') }}" class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:scale-110 transition-transform duration-300">
                    Book Now
                </a>
            </div>
        </section>

        <!-- Features Section (Inspired by "THE ICS DIFFERENCE") -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center">Why Choose Us?</h2>
                <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Professional Chauffeurs</h3>
                        <p class="mt-2 text-gray-600">Highly trained and screened for top-quality service.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Modern Fleet</h3>
                        <p class="mt-2 text-gray-600">Luxury vehicles with insurance coverage.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">24/7 Support</h3>
                        <p class="mt-2 text-gray-600">First-class customer service before, during, and after your ride.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fleet Section -->
        <section class="py-16 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center">Our First-Class Fleet</h2>

                <!-- Mobile: Horizontal Scroll -->
                <div class="mt-10 block sm:hidden overflow-x-auto">
                    <div class="flex space-x-4 pb-4">
                        @foreach(\App\Models\Vehicle::where('is_available', true)->get() as $vehicle)
                            <div class="min-w-[250px] bg-white rounded-lg shadow-md overflow-hidden flex-shrink-0 hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $vehicle->name }}</h3>
                                    <!-- <p class="text-gray-600">Type: {{ $vehicle->type }}</p> -->
                                    <p class="text-gray-600">Passengers: {{ $vehicle->passenger_capacity }}</p>
                                    <p class="text-gray-600">Luggage: {{ $vehicle->luggage_capacity }}</p>
                                    <p class="mt-2 text-gray-600 text-sm">{{ $vehicle->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tablet & Desktop: Grid -->
                <div class="mt-10 hidden sm:grid grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(\App\Models\Vehicle::where('is_available', true)->get() as $vehicle)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">{{ $vehicle->name }}</h3>
                                <!-- <p class="text-gray-600">Type: {{ $vehicle->type }}</p> -->
                                <p class="text-gray-600">Passengers: {{ $vehicle->passenger_capacity }}</p>
                                <p class="text-gray-600">Luggage: {{ $vehicle->luggage_capacity }}</p>
                                <p class="mt-2 text-gray-600 text-sm">{{ $vehicle->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <livewire:feedback-form />
        </section>
        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @livewireScripts

</body>
</html>