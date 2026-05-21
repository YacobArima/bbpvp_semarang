@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>{{ $title ? $title . ' - ' . config('app.name', 'BBPVP Semarang') : config('app.name', 'BBPVP Semarang') . ' - Admin' }}</title>

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

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .blob-shape {
            position: absolute;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.3;
        }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-800" x-data="{ mobileOpen: false }">
    <div class="flex h-screen relative overflow-hidden bg-slate-50 w-full">
        <!-- Sidebar Column -->
        @include('layouts.sidebar')

        <!-- Main Content Column -->
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto scroll-smooth transition-all duration-300">

            <!-- Top Navigation / Header -->
            <header
                class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Toggle -->
                    <button @click="mobileOpen = true"
                        class="md:hidden text-gray-500 hover:text-primary focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg>
                    </button>

                    @isset($header)
                        <h1 class="text-xl font-bold text-gray-800">
                            {{ $header }}
                        </h1>
                    @endisset
                </div>

                <!-- User Profile Dropdown -->
                <div class="flex items-center">
                    <x-dropdown align="right" width="56"
                        content-classes="py-1 bg-white shadow-2xl border border-gray-100">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-100 shadow-sm hover:bg-gray-50 transition-all duration-200 focus:outline-none group">
                                <div class="hidden sm:flex flex-col items-end">
                                    <span
                                        class="text-sm font-bold text-black group-hover:text-primary transition-colors">{{ Auth::user()->name }}</span>
                                    <span
                                        class="text-[10px] text-gray-900 font-bold uppercase tracking-wider opacity-60">Administrator</span>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-extrabold text-sm shadow-sm ring-2 ring-white group-hover:ring-primary/10 transition-all">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-black transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Account Details
                                </p>
                                <p class="text-sm font-bold text-black mt-0.5">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-500 font-medium truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-1">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="rounded-lg font-semibold text-black hover:bg-gray-50">
                                    {{ __('My Profile') }}
                                </x-dropdown-link>

                                <a href="{{ route('alumni.public') }}"
                                    class="block w-full px-4 py-2 text-start text-sm leading-5 font-semibold text-black hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out rounded-lg">
                                    {{ __('Lihat Web Publik') }}
                                </a>

                                <div class="my-1 border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-600 font-bold hover:bg-red-50 rounded-lg">
                                        {{ __('Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 max-w-7xl mx-auto w-full">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>