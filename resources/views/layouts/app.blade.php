<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ dark }" x-data="app">

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
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script defer src="https://unpkg.com/@alpinejs/ui@3.13.7-beta.0/dist/cdn.min.js"></script>

    @livewireStyles

    @stack('head')
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        {{-- Sidebar --}}
        @include('partials.sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.navbar')
            <main class="h-full overflow-y-auto">
                @include('partials.alert-success-error')
                @yield('content')
            </main>
        </div>
    </div>
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}
    @livewireScripts
</body>

@stack('extraJs')

</html>
