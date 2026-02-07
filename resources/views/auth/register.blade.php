<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100">
            
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-indigo-900">Join BookBus</h2>
                <p class="text-gray-500 mt-2">Start your journey across Morocco today.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="email" :value="__('Email Address')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="phone_number" :value="__('Phone Number')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="phone_number" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="phone_number" :value="old('phone_number')" placeholder="06..." required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="password" :value="__('Password')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-900 font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex flex-col items-center justify-end mt-8">
                    <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg rounded-xl text-lg tracking-wide">
                        {{ __('Create Account') }}
                    </x-primary-button>

                    <a class="mt-4 underline text-sm text-gray-600 hover:text-indigo-900" href="{{ route('login') }}">
                        {{ __('Already have an account? Log in') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>