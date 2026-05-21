<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
    </x-slot>

    <div class="space-y-6">
        <!-- Welcome Banner -->
        <div class="relative bg-white rounded-3xl p-8 overflow-hidden border border-gray-100/50 shadow-sm">
            <!-- Decorative background elements -->
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
            <div class="absolute right-20 -bottom-20 w-48 h-48 bg-accent/10 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold tracking-wide uppercase mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        Sistem Informasi
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Selamat Datang kembali, <span class="text-primary">{{ auth()->user()->name }}</span>!
                    </h2>
                    <p class="text-slate-500 font-medium max-w-xl">
                        Kelola data master jurusan, pantau status alumni, dan atur portal publik BBPVP Semarang dari
                        satu dashboard terpusat.
                    </p>
                </div>

                <div class="flex-shrink-0 flex gap-3">
                    <a href="{{ route('admin.jurusans.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-lg shadow-primary/20 hover:-translate-y-0.5 transition-all">
                        <svg class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Jurusan
                    </a>
                </div>
            </div>
        </div>

        <!-- Metrics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Alumni Card -->
            <div
                class="bg-white rounded-3xl p-6 border border-gray-100/50 shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    <svg class="w-24 h-24 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div class="flex items-center gap-4 mb-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-50 text-primary flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Total Alumni</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ \App\Models\Alumni::count() }}</h3>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-sm text-slate-500 font-medium flex items-center gap-1.5">
                        <span class="text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            Terdaftar
                        </span>
                        di seluruh jurusan
                    </p>
                </div>
            </div>

            <!-- Total Jurusan Card -->
            <div
                class="bg-white rounded-3xl p-6 border border-gray-100/50 shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                    <svg class="w-24 h-24 text-accent" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                        </path>
                    </svg>
                </div>
                <div class="flex items-center gap-4 mb-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-2xl bg-amber-50 text-accent flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Total Jurusan</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ \App\Models\Jurusan::count() }}</h3>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-sm text-slate-500 font-medium">Program pelatihan aktif</p>
                </div>
            </div>

            <!-- Employed Ratio Card -->
            <div class="bg-slate-900 rounded-3xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 pointer-events-none"></div>
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-primary/30 rounded-full blur-2xl"></div>

                <div class="flex items-center gap-4 mb-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-2xl bg-white/10 text-white flex items-center justify-center group-hover:bg-white/20 transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Alumni Bekerja</p>
                        @php
                            $totalAlumni = \App\Models\Alumni::count();
                            $bekerja = \App\Models\Alumni::where('employment_status', 'bekerja')->count();
                            $percentage = $totalAlumni > 0 ? round(($bekerja / $totalAlumni) * 100) : 0;
                        @endphp
                        <h3 class="text-3xl font-black text-white mt-1">{{ $percentage }}%</h3>
                    </div>
                </div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="flex-1 bg-white/10 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-accent h-full rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-300">{{ $bekerja }} / {{ $totalAlumni }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Access Menu -->
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mt-8 mb-4">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                </path>
            </svg>
            Jalan Pintas
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <a href="{{ route('admin.alumni.index') }}"
                class="group block bg-white border border-gray-100/50 rounded-2xl p-5 hover:border-primary/30 hover:shadow-lg hover:shadow-primary/5 transition-all">
                <div class="flex justify-between items-center mb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-primary transition-colors translate-x-0 group-hover:translate-x-1"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-slate-900 group-hover:text-primary transition-colors">Kelola Alumni</h4>
                <p class="text-sm text-slate-500 mt-1">Lihat dan perbarui data lulusan</p>
            </a>

            <a href="{{ route('admin.jurusans.index') }}"
                class="group block bg-white border border-gray-100/50 rounded-2xl p-5 hover:border-accent/30 hover:shadow-lg hover:shadow-accent/5 transition-all">
                <div class="flex justify-between items-center mb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center group-hover:bg-accent group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-accent transition-colors translate-x-0 group-hover:translate-x-1"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-slate-900 group-hover:text-accent transition-colors">Kelola Jurusan</h4>
                <p class="text-sm text-slate-500 mt-1">Daftar program dan pelatihan</p>
            </a>

            <a href="{{ route('alumni.public') }}" target="_blank"
                class="group block bg-white border border-gray-100/50 rounded-2xl p-5 hover:border-green-500/30 hover:shadow-lg hover:shadow-green-500/5 transition-all">
                <div class="flex justify-between items-center mb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-green-500 transition-colors -translate-y-0 translate-x-0 group-hover:-translate-y-0.5 group-hover:translate-x-0.5"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-slate-900 group-hover:text-green-500 transition-colors">Web Publik</h4>
                <p class="text-sm text-slate-500 mt-1">Lihat halaman depan portal</p>
            </a>
        </div>
    </div>
</x-app-layout>