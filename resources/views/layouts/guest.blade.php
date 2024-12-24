<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <!-- Logo Section -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/task-logo.svg') }}" alt="Task Management Logo"
                class="w-24 h-24 border-4 border-gray-300 rounded-full shadow-md">
            <h1 class="mt-1 text-xl font-bold text-gray-700">Task Management System</h1>
        </div>

        <!-- Content Section -->
        <div class="w-full px-6 py-4 mt-1 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>


</html>
