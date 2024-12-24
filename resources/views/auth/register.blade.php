<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="w-full max-w-md px-8 py-6 bg-white rounded-lg shadow-lg">
        @csrf

        <!-- Form Header -->
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Create Your Account</h1>
            <p class="mt-1 text-sm text-gray-500">Join us and start managing your tasks effectively</p>
        </div>

        <!-- Name -->
        <div class="mt-6">
            <x-input-label for="name" :value="__('Name')" class="font-medium text-gray-700" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required
                autocomplete="username"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-700" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-gray-700" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
                class="text-sm text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Already registered?
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
