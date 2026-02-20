<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Welcome Card -->
            <div
                class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 p-8 border border-white/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-500 leading-relaxed mb-6">Kelola data alumni dan jurusan BBPVP Semarang melalui
                        dashboard ini.</p>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.jurusans.index') }}"
                            class="px-6 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-blue-900/20 hover:shadow-blue-900/30 hover:-translate-y-0.5 transition active:scale-95">
                            Kelola Jurusan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div
                class="bg-gradient-to-br from-primary to-blue-800 rounded-3xl shadow-xl p-8 text-white flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-1 opacity-80">Ringkasan Sistem</h3>
                    <p class="text-sm opacity-60">Status data saat ini</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div>
                        <span class="block text-4xl font-extrabold">{{ \App\Models\Alumni::count() }}</span>
                        <span class="text-sm font-medium opacity-70 italic">Total Alumni</span>
                    </div>
                    <div>
                        <span class="block text-4xl font-extrabold">{{ \App\Models\Jurusan::count() }}</span>
                        <span class="text-sm font-medium opacity-70 italic">Total Jurusan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Section -->
        <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-accent rounded-full"></span>
            Akses Cepat
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.jurusans.create') }}"
                class="bg-white p-6 rounded-2xl border border-gray-100 hover:border-primary/20 hover:shadow-lg transition group">
                <div
                    class="w-12 h-12 bg-blue-50 text-primary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h5 class="font-bold text-gray-900">Tambah Jurusan</h5>
                <p class="text-xs text-gray-500 mt-1">Buat data master jurusan baru</p>
            </a>

            <a href="{{ route('admin.alumni.index') }}"
                class="bg-white p-6 rounded-2xl border border-gray-100 hover:border-primary/20 hover:shadow-lg transition group">
                <div
                    class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <h5 class="font-bold text-gray-900">Kelola Alumni</h5>
                <p class="text-xs text-gray-500 mt-1">Lihat dan edit profil alumni</p>
            </a>

            <a href="{{ route('alumni.public') }}"
                class="bg-white p-6 rounded-2xl border border-gray-100 hover:border-primary/20 hover:shadow-lg transition group">
                <div
                    class="w-12 h-12 bg-amber-50 text-accent rounded-xl flex items-center justify-center mb-4 group-hover:bg-accent group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <h5 class="font-bold text-gray-900">Lihat Web Publik</h5>
                <p class="text-xs text-gray-500 mt-1">Cek tampilan list alumni di web</p>
            </a>
        </div>
    </div>
</x-app-layout>