<footer class="bg-gray-800 text-white pt-8 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('/limoatdoorblue.png') }}" alt="Limo At Door Logo" class="h-12 w-auto">
                    <h2 class="text-xl font-medium hidden md:block">Limo At Door</h2>
                </div>
                <p class="mt-2 text-gray-400">Global chauffeur and travel services in over 1,000 cities.</p>
            </div>
            <div>
                <h3 class="text-lg font-medium">Quick Links</h3>
                <ul class="mt-2 space-y-2">
                    <li><a href="{{ route('home') }}" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">Home</a></li>
                    <li><a href="{{ route('book') }}" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">Book Now</a></li>
                    <li><a href="{{ route('contact') }}" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">Contact Us</a></li>
                    <li><a href="{{ route('privacy.policy') }}" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-medium">Contact</h3>
                <ul class="mt-2 space-y-2">
                    <!-- <li><a href="tel:+12125612600" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">
                        Phone: (281) 541-9224
                    </a></li> -->
                    <li><a href="mailto:limoatdoor@gmail.com" class="inline-block text-gray-400 hover:text-white hover:scale-110 transition-transform duration-300">
                        Email: limoatdoor@gmail.com
                    </a></li>
                </ul>
            </div>

        </div>
        <div class="mt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Limo At Door. All rights reserved.</p>
        </div>
    </div>
</footer>