<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ config('app.name', 'BBPVP Semarang') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .blob-shape {
            position: absolute;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.5;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob-shape bg-blue-200 w-[500px] h-[500px] rounded-full top-[-200px] left-[-200px] fixed"></div>
        <div class="blob-shape bg-amber-100 w-[400px] h-[400px] rounded-full bottom-[-100px] right-[-100px] fixed">
        </div>
        <div class="absolute inset-0 z-0 opacity-[0.3]"
            style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 32px 32px;"></div>

        <!-- Logo -->
        <div class="relative z-10 mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo" class="h-16 w-auto">
                <span class="font-bold text-2xl text-primary tracking-tight">BBPVP Semarang</span>
            </a>
        </div>

        <!-- Card -->
        <div
            class="relative z-10 w-full sm:max-w-md px-8 py-8 bg-white/80 backdrop-blur-xl shadow-xl border border-white/50 overflow-hidden rounded-2xl">
            {{ $slot }}
        </div>

        <!-- Footer Link -->
        <div class="relative z-10 mt-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary transition">&larr; Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>