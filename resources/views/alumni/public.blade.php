<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Data Alumni - BBPVP Semarang</title>

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

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -5px rgba(21, 64, 106, 0.15);
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

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 hover:text-primary font-medium transition duration-200">Home</a>
                    <a href="{{ route('alumni.public') }}"
                        class="text-primary font-semibold transition duration-200">Data Alumni</a>
                </div>

                <!-- Login/Logout Button -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-sm">
                                Dashboard Admin
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-sm">
                            Login
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
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary font-medium py-2">Home</a>
                    <a href="{{ route('alumni.public') }}" class="text-primary font-semibold py-2">Data Alumni</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/dashboard') }}"
                                class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full text-center hover:bg-blue-700 transition">Dashboard
                                Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="w-full px-6 py-2.5 text-red-600 font-semibold text-center hover:bg-red-50 rounded-full transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 bg-primary text-white font-semibold rounded-full text-center hover:bg-blue-700 transition">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="pt-32 pb-12 bg-gradient-to-br from-primary to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Data Alumni</h1>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto mb-10">Daftar alumni peserta pelatihan BBPVP Semarang</p>
            
            <!-- Search Bar (Refined Aesthetic) -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('alumni.public') }}" method="GET" class="flex items-center space-x-4">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" id="alumni-search" value="{{ request('search') }}"
                            class="block w-full ps-11 pe-4 py-4 bg-white/95 backdrop-blur-sm border-2 border-white/20 text-gray-900 text-base rounded-2xl focus:ring-4 focus:ring-white/20 focus:border-white transition-all shadow-xl placeholder:text-gray-400" 
                            placeholder="Cari nama alumni, jurusan, atau tahun..." />
                    </div>
                    <button type="submit" class="inline-flex items-center text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-2xl text-base px-8 py-4 transition-all active:scale-95 shadow-lg shadow-blue-900/20">
                        <svg class="w-5 h-5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                        Cari
                    </button>
                </form>
                @if(request('search'))
                    <div class="mt-6 flex justify-center animate-in fade-in slide-in-from-top-2 duration-500">
                        <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-white/15 backdrop-blur-md rounded-full border border-white/20 shadow-xl">
                            <div class="flex items-center gap-2 text-white text-sm font-medium">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span>Menampilkan hasil: <span class="font-bold italic">"{{ request('search') }}"</span></span>
                            </div>
                            <div class="w-px h-4 bg-white/20"></div>
                            <a href="{{ route('alumni.public') }}" class="group flex items-center gap-1.5 text-white text-xs font-black uppercase tracking-wider hover:text-accent transition-all">
                                <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Bersihkan
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Alumni Grid -->
    <main class="py-16 bg-gray-50 min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @auth
                <div class="flex justify-between items-center mb-12">
                    <div>
                        <p class="text-gray-600">Selamat datang, <span
                                class="font-semibold text-gray-900">{{ auth()->user()->name }}</span></p>
                    </div>
                    <div class="flex items-center gap-4">
                        @if(auth()->user()->alumni)
                            <a href="{{ route('alumni.edit', auth()->user()->alumni) }}"
                                class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Data Saya
                            </a>
                        @else
                            <a href="{{ route('alumni.create') }}"
                                class="px-6 py-2.5 bg-accent text-white font-semibold rounded-full hover:bg-yellow-600 transition shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                Tambah Data Alumni
                            </a>
                        @endif
                    </div>
                </div>
            @endauth

            @if(!$selectedJurusan && !request('search'))
                <!-- Department Grid -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Pilih Jurusan</h2>
                    <p class="text-gray-500">Lihat data alumni berdasarkan bidang keahlian</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($jurusans as $jurusan)
                        <a href="{{ route('alumni.public', ['jurusan_id' => $jurusan->id]) }}" 
                           class="group bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 flex flex-col items-center text-center">
                            <div class="w-20 h-20 rounded-2xl bg-primary/5 flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                                <svg class="w-10 h-10 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-primary mb-2 line-clamp-1">{{ $jurusan->name }}</h3>
                            <p class="text-gray-500 font-medium mb-4">{{ $jurusan->alumni_count }} Alumni Terdaftar</p>
                            <span class="px-6 py-2 bg-gray-50 text-gray-600 rounded-full text-sm font-bold group-hover:bg-primary group-hover:text-white transition-all duration-300 flex items-center gap-2">
                                Lihat Peserta
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Back Button & Title -->
                <div class="mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div>
                        @if($isAdmin)
                        <a href="{{ route('alumni.public') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:gap-3 transition-all mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Jurusan
                        </a>
                        @endif
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            @if(request('search'))
                                Hasil Pencarian
                            @elseif(!$isAdmin && !$hasProfile)
                                Lengkapi Profil
                            @elseif(!$isAdmin && $hasProfile)
                                Teman Sekelas Saya
                            @else
                                Alumni {{ $selectedJurusan->name ?? 'Data Alumni' }}
                            @endif
                        </h2>
                        @if(isset($activePelatihan))
                            <p class="mt-2 text-primary font-semibold flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                Kelas: {{ $activePelatihan->name }}
                            </p>
                        @endif
                    </div>

                    @if($isAdmin && count($pelatihans) > 0)
                        <!-- Admin Pelatihan Filter -->
                        <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Filter Kelas:</span>
                            <form action="{{ route('alumni.public') }}" method="GET" class="flex items-center gap-2">
                                <input type="hidden" name="jurusan_id" value="{{ request('jurusan_id') }}">
                                <select name="pelatihan_id" onchange="this.form.submit()" 
                                    class="bg-gray-50 border-none text-gray-900 text-sm font-bold rounded-2xl focus:ring-2 focus:ring-primary/20 block w-full px-4 py-2.5 min-w-[200px]">
                                    <option value="">Semua Kelas</option>
                                    @foreach($pelatihans as $p)
                                        <option value="{{ $p->id }}" {{ request('pelatihan_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(request('pelatihan_id'))
                                    <a href="{{ route('alumni.public', ['jurusan_id' => request('jurusan_id')]) }}" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition shadow-sm" title="Clear Filter">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </a>
                                @endif
                            </form>
                        </div>
                    @endif
                </div>

                @if($alumni->isEmpty())
                    <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-gray-300">
                        <div class="inline-block p-6 rounded-full bg-gray-50 shadow-sm mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        @if(!$isAdmin && !$hasProfile)
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Isi data terlebih dahulu</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">Silakan lengkapi profil alumni Anda untuk melihat daftar rekan sekelas sesuai pilihan pelatihan Anda.</p>
                            <a href="{{ route('alumni.create') }}"
                                class="inline-block px-8 py-3 bg-accent text-white font-medium rounded-full hover:bg-yellow-600 transition">Lengkapi Data Sekarang</a>
                        @else
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Menemukan Data</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">Kami tidak dapat menemukan alumni yang Anda cari di kategori ini.</p>
                            @if($isAdmin)
                            <a href="{{ route('alumni.public') }}"
                                class="inline-block px-8 py-3 bg-primary text-white font-medium rounded-full hover:bg-blue-800 transition">Lihat Semua Jurusan</a>
                            @endif
                        @endif
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($alumni as $alumnus)
                            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 card-hover group flex flex-col h-full hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500">
                                <!-- Photo Section -->
                                <div class="h-64 relative overflow-hidden bg-gray-50">
                                    @if($alumnus->photo_path)
                                        <img src="{{ asset('storage/' . $alumnus->photo_path) }}" alt="{{ $alumnus->user->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-200">
                                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Status Badge (Top Right Overlay) -->
                                    <div class="absolute top-4 right-4 z-10">
                                        @if($alumnus->employment_status == 'bekerja')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-500/90 backdrop-blur-md rounded-full text-[9px] font-black text-white uppercase tracking-widest border border-green-400/30 shadow-lg shadow-green-900/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                                Bekerja
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-900/80 backdrop-blur-md rounded-full text-[9px] font-black text-white/90 uppercase tracking-widest border border-white/10 shadow-lg shadow-black/20">
                                                Mencari Kerja
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="p-6 flex flex-col flex-1">
                                    <div class="mb-4">
                                        <h3 class="text-xl font-extrabold text-gray-900 mb-1 line-clamp-1 hover:text-primary transition-colors">{{ $alumnus->user->name }}</h3>
                                        <div class="flex flex-col gap-1">
                                            <span class="text-primary font-bold text-xs uppercase tracking-wider">
                                                {{ $alumnus->jurusan->name }}
                                            </span>
                                            <span class="text-gray-500 text-[13px] font-medium leading-snug">
                                                {{ $alumnus->pelatihan->name ?? 'Pelatihan Umum' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 mb-5 border-y border-gray-50 py-3">
                                        <div class="flex items-center gap-1.5 text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-xs font-bold">{{ $alumnus->graduation_year }}</span>
                                        </div>
                                        <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
                                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter">Angkatan Lulus</div>
                                    </div>

                                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 italic mb-6 flex-1">
                                        "{{ $alumnus->description ?? 'Bangga menjadi bagian dari BBPVP Semarang.' }}"
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo" class="h-8 w-auto brightness-0 invert">
                    <span class="font-bold text-lg text-white tracking-tight">BBPVP Semarang</span>
                </div>
                <div class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} BBPVP Semarang - Kementerian Ketenagakerjaan RI
                </div>
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