<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Script -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-blue-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log
                        in</a>

                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif --}}
                @endauth
            </div>
        @endif

        <div class="container mx-auto py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pembelians Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-2">Pembelians</h2>
                    <p class="text-gray-600 text-lg">{{ $pembeliansCount }}</p>
                </div>
                <!-- Penjualans Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-2">Penjualans</h2>
                    <p class="text-gray-600 text-lg">{{ $penjualansCount }}</p>
                </div>
                <!-- User Pinjamans Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-2">User Pinjamans</h2>
                    <p class="text-gray-600 text-lg">{{ $userpinjamansCount }}</p>
                </div>
                <!-- User Tabungans Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-2">User Tabungans</h2>
                    <p class="text-gray-600 text-lg">{{ $usertabungansCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Optional: Add JavaScript for further interactivity if needed
    </script>
</body>

</html>
