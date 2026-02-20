<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Profil Alumni') }}
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <style>
        .cropper-container {
            max-width: 100%;
            max-height: 400px;
        }
    </style>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div
            class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 p-8 border border-white/50 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>

            <div class="mb-8 flex items-center gap-4 relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-primary">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $alumnus->user->name }}</h3>
                    <p class="text-sm text-gray-400">{{ $alumnus->user->email }}</p>
                </div>
            </div>

            <form action="{{ route('admin.alumni.update', $alumnus) }}" method="POST" enctype="multipart/form-data"
                class="relative z-10">
                @csrf
                @method('PUT')

                <div x-data="{ 
                    selectedJurusan: '{{ old('jurusan_id', $alumnus->jurusan_id) }}',
                    selectedPelatihan: '{{ old('pelatihan_id', $alumnus->pelatihan_id) }}',
                    jurusans: {{ $jurusans->toJson() }},
                    get filteredPelatihans() {
                        if (!this.selectedJurusan) return [];
                        const jurusan = this.jurusans.find(j => j.id == this.selectedJurusan);
                        return jurusan ? jurusan.pelatihans : [];
                    }
                }">
                    <!-- Jurusan -->
                    <div class="mb-6">
                        <label for="jurusan_id"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" x-model="selectedJurusan"
                            @change="selectedPelatihan = ''"
                            class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                            required>
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pelatihan -->
                    <div class="mb-6">
                        <label for="pelatihan_id"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama
                            Pelatihan</label>
                        <select name="pelatihan_id" id="pelatihan_id" x-model="selectedPelatihan"
                            class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all disabled:opacity-50"
                            :disabled="!selectedJurusan" required>
                            <option value="">Pilih Pelatihan</option>
                            <template x-for="p in filteredPelatihans" :key="p.id">
                                <option :value="p.id" x-text="p.name" :selected="p.id == selectedPelatihan"></option>
                            </template>
                        </select>
                        @error('pelatihan_id')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tahun Lulus -->
                <div class="mb-6">
                    <label for="graduation_year"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tahun Lulus</label>
                    <input type="number" name="graduation_year" id="graduation_year" min="1900"
                        max="{{ date('Y') + 1 }}"
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                        required value="{{ old('graduation_year', $alumnus->graduation_year) }}">
                    @error('graduation_year')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <label for="address"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat
                        Lengkap</label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                        required>{{ old('address', $alumnus->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div class="mb-6">
                    <label for="phone_number"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor HP /
                        WhatsApp</label>
                    <input type="text" name="phone_number" id="phone_number"
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                        required value="{{ old('phone_number', $alumnus->phone_number) }}">
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ employmentStatus: '{{ old('employment_status', $alumnus->employment_status) }}' }">
                    <!-- Status Bekerja -->
                    <div class="mb-6">
                        <label for="employment_status"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Status
                            Pekerjaan</label>
                        <select name="employment_status" id="employment_status" x-model="employmentStatus"
                            class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all"
                            required>
                            <option value="bekerja">Telah Bekerja</option>
                            <option value="belum_bekerja">Belum Bekerja</option>
                        </select>
                        @error('employment_status')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employment Details (Conditional) -->
                    <div x-show="employmentStatus === 'bekerja'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mb-6 p-6 bg-gray-50/50 rounded-3xl border border-gray-100 space-y-4">

                        <div>
                            <label for="company_name"
                                class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama
                                Perusahaan</label>
                            <input type="text" name="company_name" id="company_name"
                                class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary transition-all"
                                :required="employmentStatus === 'bekerja'"
                                value="{{ old('company_name', $alumnus->company_name) }}" placeholder="PT. Contoh Jaya">
                            @error('company_name')
                                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="position"
                                class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Posisi /
                                Jabatan</label>
                            <input type="text" name="position" id="position"
                                class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary transition-all"
                                :required="employmentStatus === 'bekerja'"
                                value="{{ old('position', $alumnus->position) }}" placeholder="Manager">
                            @error('position')
                                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi
                        Diri</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-900 shadow-sm focus:border-primary focus:ring-primary focus:bg-white transition-all">{{ old('description', $alumnus->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo Input -->
                <div class="mb-8" x-data="{ 
                    showModal: false, 
                    cropper: null,
                    fileName: '',
                    croppedImage: '{{ $alumnus->photo_path ? asset('storage/' . $alumnus->photo_path) : '' }}',
                    handleFile(e) {
                        const file = e.target.files[0];
                        if (file) {
                            if (file.size > 200 * 1024) {
                                alert('Ukuran file terlalu besar (Maks 200KB).');
                                return;
                            }
                            this.fileName = file.name;
                            const reader = new FileReader();
                            reader.onload = (event) => {
                                const img = this.$refs.croppingImage;
                                img.src = event.target.result;
                                this.showModal = true;
                                img.onload = () => {
                                    if (this.cropper) {
                                        this.cropper.destroy();
                                    }
                                    this.initCropper();
                                };
                            };
                            reader.readAsDataURL(file);
                        }
                    },
                    initCropper() {
                        this.cropper = new Cropper(this.$refs.croppingImage, {
                            aspectRatio: 1,
                            viewMode: 2,
                            guides: true,
                            background: false,
                            autoCropArea: 1,
                            zoomable: true
                        });
                    },
                    saveCrop() {
                        const canvas = this.cropper.getCroppedCanvas({
                            width: 400,
                            height: 400,
                        });
                        this.croppedImage = canvas.toDataURL('image/jpeg', 0.8);
                        document.getElementById('cropped_image_input').value = this.croppedImage;
                        this.showModal = false;
                    }
                }">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Foto
                        Profil</label>
                    <div class="flex items-center gap-6">
                        <!-- Preview Box -->
                        <div
                            class="w-20 h-20 rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative group">
                            <template x-if="croppedImage">
                                <img :src="croppedImage" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!croppedImage">
                                <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                            </template>
                        </div>

                        <div class="flex-1">
                            <input type="file" id="photo_input" accept="image/*" @change="handleFile" class="hidden">
                            <input type="hidden" name="cropped_image" id="cropped_image_input">
                            <label for="photo_input"
                                class="inline-flex items-center px-6 py-3 bg-gray-50 text-gray-600 font-bold rounded-xl border border-gray-200 hover:border-primary/20 hover:bg-white transition-all cursor-pointer text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Pilih & Potong Foto
                            </label>
                            <p class="text-[10px] text-gray-400 mt-2 font-medium uppercase tracking-tight">Format: JPG,
                                PNG • Max: 200KB</p>
                        </div>
                    </div>

                    <!-- Cropping Modal -->
                    <div x-show="showModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
                        <div class="flex items-center justify-center min-h-screen p-4">
                            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                                @click="showModal = false"></div>

                            <div class="relative bg-white rounded-3xl w-full max-w-4xl shadow-2xl overflow-hidden">
                                <div
                                    class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                    <h3 class="text-xl font-extrabold text-gray-900">Potong Foto Profil</h3>
                                    <button type="button" @click="showModal = false"
                                        class="text-gray-400 hover:text-gray-600 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="p-8">
                                    <div
                                        class="cropper-container bg-gray-100 rounded-2xl overflow-hidden mb-8 shadow-inner">
                                        <img x-ref="croppingImage" src="" class="max-w-full block">
                                    </div>
                                    <div class="flex items-center justify-end gap-3">
                                        <button type="button" @click="showModal = false"
                                            class="px-6 py-3 text-gray-500 font-bold hover:text-gray-700 transition">Batal</button>
                                        <button type="button" @click="saveCrop()"
                                            class="px-8 py-3 bg-primary text-white font-extrabold rounded-2xl shadow-lg shadow-blue-900/20 hover:shadow-blue-900/30 hover:-translate-y-0.5 transition active:scale-95">
                                            Simpan Potongan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @error('cropped_image')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <a href="{{ route('admin.alumni.index') }}"
                        class="text-gray-400 hover:text-gray-600 font-bold transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-10 py-4 bg-primary text-white font-extrabold rounded-2xl shadow-lg shadow-blue-900/20 hover:shadow-blue-900/30 hover:-translate-y-0.5 transition active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>