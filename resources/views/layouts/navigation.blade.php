<nav x-data="{ open: false }" class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="/limoatdoorblue.png" alt="Limo At Door" class="h-12 transition-transform duration-300 hover:scale-110">
                </a>
            </div>


            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = !open" type="button" class="text-gray-700 focus:outline-none focus:text-blue-600">
                    <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="open" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('book') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-md font-bold hover:scale-110 transition-transform duration-300">Book Now</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-md font-bold hover:scale-110 transition-transform duration-300">Contact</a>
                @auth
                    <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name }}</span>
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-md font-bold hover:scale-110 transition-transform duration-300">My Bookings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-md font-bold hover:scale-110 transition-transform duration-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-md font-bold hover:scale-110 transition-transform duration-300">Login</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-md font-bold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:scale-110 transition-transform duration-300">Sign Up</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Nav -->
        <div x-show="open" class="md:hidden mt-2 mb-2 space-y-2">
            <a href="{{ route('book') }}" class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300">Book Now</a>
            <a href="{{ route('contact') }}" class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300">Contact</a>
            @auth
                <span class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="">
                    @csrf
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300 mb-2">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300">Login</a>
                <a href="{{ route('register') }}" class="block text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium mx-3 hover:scale-110 transition-transform duration-300">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>
