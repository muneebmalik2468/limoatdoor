@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <!-- Contact Info Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Contact Us</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Image on Left -->
            <div class="order-1 lg:order-1">
                <img src="{{ asset('/contact.jpg') }}" alt="Contact Us Image" class="w-full h-auto rounded-lg shadow-md">
            </div>
            <!-- Info on Right -->
            <div class="order-2 lg:order-2 flex flex-col justify-center">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Get in Touch</h2>
                <p class="text-gray-600 mb-6">We're here to assist you with your travel needs. Reach out via phone, email, or the form below.</p>
                <ul class="space-y-4">
                    {{-- <!-- <li class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Phone: (281) 541-9224 (Call or SMS)</span>
                    </li> --> --}}
                    <li class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span><strong>Email:</strong> info@limoatdoor.com</span>
                    </li>
                    {{-- <!-- <li class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><strong>Address:</strong> 3040 fm 1960 #144, Houston, TX 77073.</span>
                    </li> --> --}}
                </ul>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Send Us a Message</h2>
            @if(session('status'))
                <div 
                    id="form-status"
                    class="mb-6 p-4 rounded-md bg-green-100 text-green-800"
                    role="alert"
                    aria-live="polite"
                >
                    {{ session('status') }}
                </div>
            @elseif(session('error'))
                <div 
                    id="form-status"
                    class="mb-6 p-4 rounded-md bg-red-100 text-red-800"
                    role="alert"
                    aria-live="polite"
                >
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" id="subject" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection