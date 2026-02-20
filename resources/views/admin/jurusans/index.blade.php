<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Jurusan') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="w-full sm:w-auto">
                <h3 class="text-gray-500 font-medium tracking-wide">Kelola data program keahlian pelatihan</h3>
                <form action="{{ route('admin.jurusans.index') }}" method="GET" class="mt-4 flex gap-2">
                    <div class="relative flex-1 sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari jurusan atau pelatihan..."
                            class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary transition-all text-sm group-hover:border-gray-200">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition shadow-sm text-sm">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('admin.jurusans.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition text-sm">Reset</a>
                    @endif
                </form>
            </div>
            <a href="{{ route('admin.jurusans.create') }}"
                class="w-full sm:w-auto px-6 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-blue-900/20 hover:shadow-blue-900/30 hover:-translate-y-0.5 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Jurusan Baru
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div
                class="mb-8 px-6 py-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 overflow-hidden border border-white/50">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 italic-table">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Nama Jurusan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Nama Pelatihan</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse($jurusans as $jurusan)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="font-bold text-gray-900 group-hover:text-primary transition-colors">
                                        {{ $jurusan->name }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($jurusan->pelatihans as $pelatihan)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-primary border border-blue-100">
                                                {{ $pelatihan->name }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400 italic text-sm">-</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.jurusans.edit', $jurusan) }}"
                                            class="p-2 bg-blue-50 text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.jurusans.destroy', $jurusan) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-medium">Belum ada data jurusan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($jurusans->hasPages())
                <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-100">
                    {{ $jurusans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>