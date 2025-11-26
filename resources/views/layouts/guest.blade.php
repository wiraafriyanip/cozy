<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cafe VOCA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Custom CSS (opsional, kalau kamu punya) -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        @if (!app()->environment('testing'))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <div
            class="min-h-screen flex items-center justify-center bg-cover bg-center bg-fixed relative"
            style="background-image: url('{{ asset('images/bg-cafe.jpg') }}');"
        >
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative z-10 w-full max-w-md mx-4">
                <div class="flex flex-col items-center mb-6">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-amber-400" />
                    </a>

                    <h1 class="mt-4 text-2xl font-semibold text-white tracking-wide">
                        {{ config('app.name', 'Cafe VOCA') }}
                    </h1>

                    <p class="mt-1 text-sm text-amber-100">
                        Self-ordering &amp; cozy café experience
                    </p>
                </div>

                <div class="w-full px-6 py-6 bg-white/95 backdrop-blur-sm shadow-xl rounded-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
