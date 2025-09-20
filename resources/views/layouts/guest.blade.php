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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center" style="background-image: url('/smallw.png')">
            <div>
                <a href="/">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:scale-110 transition-transform duration-300">Limo At Door</a>
                    <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        @include('components.scripts.password-toggle-script')
    </body>
</html>
