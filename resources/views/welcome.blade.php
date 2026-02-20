<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Alumni BBPVP Semarang</title>

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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .blob-shape {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.4;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-800 selection:bg-accent selection:text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo + Brand Name -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo" class="h-12 w-auto">
                    <span class="font-bold text-xl text-primary tracking-tight">BBPVP Semarang</span>
                </a>

                <!-- Navigation Links (Center-ish) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 hover:text-primary font-medium transition duration-200">Beranda</a>
                    <a href="{{ route('alumni.public') }}"
                        class="text-gray-600 hover:text-primary font-medium transition duration-200">Data Alumni</a>
                </div>

                <!-- Login Button (Right Side) -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-sm">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('alumni.public') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-sm">
                                Data Alumni
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-sm">
                            Masuk
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-500 hover:text-primary focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary font-medium py-2">Beranda</a>
                    <a href="{{ route('alumni.public') }}"
                        class="text-gray-600 hover:text-primary font-medium py-2">Data Alumni</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full text-center hover:bg-blue-700 transition">Dashboard
                                Admin</a>
                        @else
                            <a href="{{ route('alumni.public') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full text-center hover:bg-blue-700 transition">Data
                                Alumni</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="w-full px-6 py-2.5 text-red-600 font-semibold text-center hover:bg-red-50 rounded-full transition">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full text-center hover:bg-blue-700 transition">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-bbpvp.jpg') }}" alt="BBPVP Semarang" class="w-full h-full object-cover">
            <!-- Symmetrical overlay for center alignment -->
            <div class="absolute inset-0 bg-blue-950/60"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full flex justify-center">
            <div
                class="max-w-3xl p-8 md:p-12 bg-blue-950/30 backdrop-blur-md rounded-[2.5rem] border border-white/10 shadow-2xl text-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8 animate-in fade-in zoom-in duration-700">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                    </span>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">Portal Alumni
                        Terintegrasi</span>
                </div>

                <h1
                    class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight animate-in fade-in slide-in-from-top duration-1000 delay-100 drop-shadow-2xl">
                    Menghubungkan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-orange-400">Talenta</span>
                    <br class="hidden md:block" /> dengan Peluang.
                </h1>

                <p
                    class="max-w-2xl mx-auto text-lg md:text-xl text-white mb-6 leading-relaxed font-light animate-in fade-in duration-1000 delay-200 drop-shadow-md">
                    Bergabunglah dengan komunitas alumni BBPVP Semarang. Bagikan perjalanan Anda, terhubung dengan rekan
                    sejawat, dan buka peluang profesional dunia kerja.
                </p>

                <!-- Alumni Stats -->
                <div class="mb-10 animate-in fade-in zoom-in duration-1000 delay-300">
                    <div class="inline-flex flex-col items-center">
                        <span
                            class="text-4xl md:text-5xl font-black text-accent drop-shadow-sm">{{ number_format($totalAlumni ?? 0) }}</span>
                        <span class="text-white text-sm uppercase tracking-[0.2em] font-bold mt-1">Total Alumni
                            Bergabung</span>
                    </div>
                </div>

                <div
                    class="flex flex-col sm:flex-row gap-4 items-center justify-center animate-in fade-in slide-in-from-bottom duration-1000 delay-300">
                    <a href="{{ route('alumni.public') }}"
                        class="w-full sm:w-auto px-10 py-4 bg-accent text-white font-black uppercase tracking-wider rounded-2xl shadow-xl shadow-orange-900/30 hover:shadow-orange-900/50 hover:-translate-y-1 transition-all duration-300 text-center">
                        Lihat Data Alumni
                    </a>
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto px-10 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Gabung Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Hero Fade -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 to-transparent z-10"></div>
    </div>

    <!-- Features/Info Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Bergabung?</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-accent to-orange-400 rounded-full mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Jaringan Luas</h3>
                    <p class="text-gray-600">Terhubung dengan ribuan alumni dari berbagai angkatan dan jurusan.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Peluang Karir</h3>
                    <p class="text-gray-600">Akses informasi lowongan kerja eksklusif dari mitra industri.</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Profil Terverifikasi</h3>
                    <p class="text-gray-600">Tampilkan profil resmi sebagai lulusan BBPVP Semarang.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo"
                            class="h-10 w-auto brightness-0 invert">
                        <span class="font-bold text-xl text-white tracking-tight">BBPVP Semarang</span>
                    </div>
                    <p class="max-w-xs text-sm leading-relaxed mb-6">
                        Balai Besar Pelatihan Vokasi dan Produktivitas Semarang. Mewujudkan tenaga kerja kompeten,
                        produktif, dan berdaya saing.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Navigasi</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('alumni.public') }}" class="hover:text-white transition">Data Alumni</a>
                        </li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Kontak</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <span>📍</span>
                            <span>Jl. Brigjen Sudiarto No. 118, Pedurungan, Semarang</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span>✉️</span>
                            <span>info@bbpvp-semarang.kemnaker.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-xs text-gray-600">
                &copy; {{ date('Y') }} BBPVP Semarang - Kementerian Ketenagakerjaan RI
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>