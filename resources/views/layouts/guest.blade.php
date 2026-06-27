<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mau Run') — {{ config('app.name', 'Mau Run') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-surface text-ink min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    {{-- Sunset stripe top --}}
    <div class="w-full h-1 bg-gradient-to-r from-primary via-sunshine-700 via-sunshine-500 via-yellow-saturated to-cream fixed top-0 left-0 z-50"></div>

    <div class="mb-6">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Mau Run" class="h-14 w-auto mx-auto">
        </a>
    </div>

    <div class="w-full sm:max-w-md px-6 py-6 bg-cream border border-beige-deep rounded-lg shadow-card mx-4">
        {{ $slot }}
    </div>

    {{-- Sunset stripe bottom --}}
    <div class="w-full h-1 bg-gradient-to-r from-primary via-sunshine-700 via-sunshine-500 via-yellow-saturated to-cream fixed bottom-0 left-0 z-50 mt-8"></div>
</body>
</html>
