<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Alumni') }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="w-full sm:w-auto">
                <h3 class="text-gray-500 font-medium tracking-wide">Kelola data seluruh profil alumni peserta pelatihan
                </h3>
                <form action="{{ route('admin.alumni.index') }}" method="GET" class="mt-4 flex gap-2">
                    <div class="relative flex-1 sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama, email, tahun, atau jurusan..."
                            class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary transition-all text-sm group-hover:border-gray-200">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition shadow-sm text-sm">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('admin.alumni.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition text-sm">Reset</a>
                    @endif
                </form>
            </div>
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
        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-white/50 overflow-hidden"
            x-data="{ openRow: null }">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="w-12 px-6 py-5"></th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Alumni</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Jurusan & Pelatihan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Status</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse($alumni as $alumnus)
                            <tr class="hover:bg-blue-50/20 transition-all cursor-pointer group"
                                @click="openRow = (openRow === {{ $alumnus->id }} ? null : {{ $alumnus->id }})"
                                :class="openRow === {{ $alumnus->id }} ? 'bg-blue-50/40' : ''">
                                <td class="px-6 py-6 text-center">
                                    <svg class="w-4 h-4 text-gray-300 transition-transform duration-300"
                                        :class="openRow === {{ $alumnus->id }} ? 'rotate-180 text-primary' : ''" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        @if($alumnus->photo_path)
                                            <img src="{{ asset('storage/' . $alumnus->photo_path) }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold">
                                                {{ strtoupper(substr($alumnus->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-gray-900 group-hover:text-primary transition-colors">
                                                {{ $alumnus->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-400">{{ $alumnus->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-800">{{ $alumnus->jurusan->name }}</div>
                                    <div class="text-xs text-primary font-medium">{{ $alumnus->pelatihan->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    @if($alumnus->employment_status == 'bekerja')
                                        <span
                                            class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-extrabold uppercase tracking-wider border border-green-100">Bekerja</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-gray-50 text-gray-400 rounded-full text-[10px] font-extrabold uppercase tracking-wider border border-gray-100">Mencari
                                            Kerja</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium" @click.stop>
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.alumni.edit', $alumnus) }}"
                                            class="p-2 bg-blue-50 text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.alumni.destroy', $alumnus) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');">
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

                            <!-- Detail Row -->
                            <tr x-show="openRow === {{ $alumnus->id }}" x-collapse class="bg-gray-50/50">
                                <td colspan="5" class="px-8 py-8 border-t border-blue-100/30">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                        <!-- Alamat & Kontak -->
                                        <div>
                                            <h4
                                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">
                                                Informasi Kontak</h4>
                                            <div class="space-y-4">
                                                <div class="flex items-start gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-primary shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">
                                                            Alamat</div>
                                                        <div class="text-sm text-gray-700 leading-relaxed italic">
                                                            {{ $alumnus->address }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex items-start gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-primary shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">
                                                            WhatsApp / HP</div>
                                                        <div class="text-sm text-gray-700 font-black">
                                                            {{ $alumnus->phone_number }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Pekerjaan -->
                                        <div>
                                            <h4
                                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">
                                                Pekerjaan & Kelulusan</h4>
                                            <div class="space-y-4">
                                                <div class="flex items-start gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-primary shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">
                                                            Perusahaan & Posisi</div>
                                                        @if($alumnus->employment_status == 'bekerja')
                                                            <div class="text-sm text-gray-900 font-black">
                                                                {{ $alumnus->company_name }}
                                                            </div>
                                                            <div class="text-xs text-primary font-bold">{{ $alumnus->position }}
                                                            </div>
                                                        @else
                                                            <div class="text-sm text-gray-400 italic">Belum Bekerja / Mencari
                                                                Peluang</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex items-start gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-primary shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">
                                                            Tahun Lulus</div>
                                                        <div class="text-sm text-gray-900 font-black">
                                                            {{ $alumnus->graduation_year }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Deskripsi -->
                                        <div>
                                            <h4
                                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">
                                                Deskripsi / Motivasi</h4>
                                            <div class="p-4 bg-white border border-gray-100 rounded-2xl">
                                                <p class="text-xs text-gray-600 leading-relaxed italic">
                                                    "{{ $alumnus->description ?: 'Tidak ada deskripsi tambahan.' }}"
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-medium">Belum ada data alumni terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($alumni->hasPages())
                <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-100">
                    {{ $alumni->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>