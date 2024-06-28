<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme') || 'light';
            if (storedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body class="text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Flash Messages -->
    <div id="flash-message-container" class="fixed z-50 transform -translate-x-1/2 top-4 left-1/2">
        @if (session('success'))
            <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded-full flash-message"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded-full flash-message"
                role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="relative px-4 py-3 text-blue-700 bg-blue-100 border border-blue-400 rounded-full flash-message"
                role="alert">
                <strong class="font-bold">Info!</strong>
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <main class="py-8">
        {{ $slot }}
    </main>
    @vite('resources/js/app.js')
</body>

</html>
