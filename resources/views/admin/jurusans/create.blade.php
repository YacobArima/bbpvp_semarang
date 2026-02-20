<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Jurusan Baru') }}
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div
            class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 p-8 border border-white/50 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>

            <form action="{{ route('admin.jurusans.store') }}" method="POST" class="relative z-10">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama
                        Jurusan</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                        required value="{{ old('name') }}" placeholder="Contoh: Teknik Informatika">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-10" x-data="{ trainings: [''] }">
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Daftar
                            Pelatihan</label>
                        <button type="button" @click="trainings.push('')"
                            class="text-xs bg-blue-50 text-primary px-3 py-1.5 rounded-xl font-bold hover:bg-primary hover:text-white transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Baris
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(training, index) in trainings" :key="index">
                            <div class="flex gap-3 animate-fade-in">
                                <div class="flex-1 relative group">
                                    <input type="text" name="training_names[]" x-model="trainings[index]"
                                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all pl-12"
                                        required placeholder="Contoh: Web Developer Specialist">
                                    <div
                                        class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-primary transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <button type="button" @click="trainings.splice(index, 1)" x-show="trainings.length > 1"
                                    class="p-4 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    @error('training_names')
                        <p class="text-red-500 text-xs mt-4 font-bold">{{ $message }}</p>
                    @enderror
                    @error('training_names.*')
                        <p class="text-red-500 text-xs mt-4 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <a href="{{ route('admin.jurusans.index') }}"
                        class="text-gray-400 hover:text-gray-600 font-bold transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary text-white font-extrabold rounded-2xl shadow-lg shadow-blue-900/20 hover:shadow-blue-900/30 hover:-translate-y-0.5 transition active:scale-95">
                        Simpan Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>