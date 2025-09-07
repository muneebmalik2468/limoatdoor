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

        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        @livewireScripts
    </body>
</html>