<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-2"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <button type="button" onclick="togglePassword('password', this)"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-sm text-gray-600 focus:outline-none">
                    <!-- Eye (visible) icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 eye-icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51
                                7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431
                                0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <!-- Eye-slash (hidden) icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 eye-slash-icon hidden">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.477 10.477a3 3 0 0 0 4.243 4.243M16.647
                                16.647C15.179 17.494 13.613 18 12 18c-4.638 0-8.573-3.007-9.963-7.178a1.012
                                1.012 0 0 1 0-.639c.57-1.693 1.596-3.198 2.963-4.405m3.425-2.13A9.956
                                9.956 0 0 1 12 6c1.613 0 3.179.506 4.647 1.353" />
                    </svg>

                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-2"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <button type="button" onclick="togglePassword('password_confirmation', this)"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-sm text-gray-600 focus:outline-none">
                        <!-- Eye (visible) icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 eye-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51
                                    7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431
                                    0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <!-- Eye-slash (hidden) icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 eye-slash-icon hidden">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3l18 18M10.477 10.477a3 3 0 0 0 4.243 4.243M16.647
                                    16.647C15.179 17.494 13.613 18 12 18c-4.638 0-8.573-3.007-9.963-7.178a1.012
                                    1.012 0 0 1 0-.639c.57-1.693 1.596-3.198 2.963-4.405m3.425-2.13A9.956
                                    9.956 0 0 1 12 6c1.613 0 3.179.506 4.647 1.353" />
                        </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
