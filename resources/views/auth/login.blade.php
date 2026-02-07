<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100">
            
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-indigo-900">Welcome Back</h2>
                <p class="text-gray-500 mt-2">Log in to manage your bus bookings.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="password" :value="__('Password')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center justify-end mt-8">
                    <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg rounded-xl text-lg tracking-wide">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <div class="mt-6 flex flex-col items-center space-y-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-indigo-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <a class="underline text-sm text-gray-600 hover:text-indigo-900" href="{{ route('register') }}">
                            {{ __("Don't have an account? Register") }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>