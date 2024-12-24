<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md px-8 py-6 bg-white rounded-lg shadow-lg">
        @csrf
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Log in to Your Account</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your tasks effectively</p>
        </div>

        <!-- Email Address -->
        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-700" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center text-gray-600">
                <input id="remember_me" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2" name="remember">
                <span class="ml-2 text-sm">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Register Link -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Create one here
                </a>
            </p>
        </div>

        <!-- Login Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full px-4 py-2 font-medium text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1">
                Log In
            </button>
        </div>
    </form>
</x-guest-layout>
