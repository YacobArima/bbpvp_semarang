<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Data Alumni - BBPVP Semarang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .cropper-container {
            max-width: 100%;
            max-height: 500px;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo" class="h-12 w-auto">
                    <span class="font-bold text-xl text-primary tracking-tight">BBPVP Semarang</span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 hover:text-primary font-medium transition duration-200">Home</a>
                    <a href="{{ route('alumni.public') }}"
                        class="text-gray-600 hover:text-primary font-medium transition duration-200">Data Alumni</a>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="pt-32 pb-12 bg-gradient-to-br from-primary to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tambah Data Alumni</h1>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto">Lengkapi data profil Anda untuk bergabung dengan jaringan
                alumni</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-16 bg-gray-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

                <div class="mb-8">
                    <p class="text-gray-600">Halo, <span
                            class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>!</p>
                    <p class="text-sm text-gray-500 mt-1">Silakan lengkapi data alumni Anda di bawah ini.</p>
                </div>

                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div x-data="{
                    selectedJurusan: '{{ old('jurusan_id') }}',
                    selectedPelatihan: '{{ old('pelatihan_id') }}',
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
                                class="block text-sm font-semibold text-gray-800 mb-2">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" x-model="selectedJurusan"
                                @change="selectedPelatihan = ''"
                                class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                                required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Pelatihan (Dependent) -->
                        <div class="mb-6">
                            <label for="pelatihan_id" class="block text-sm font-semibold text-gray-800 mb-2">Pelatihan
                                yang Diikuti</label>
                            <select name="pelatihan_id" id="pelatihan_id" x-model="selectedPelatihan"
                                class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary disabled:bg-gray-100 disabled:cursor-not-allowed transition-colors"
                                :disabled="!selectedJurusan" required>
                                <option value="">Pilih Pelatihan</option>
                                <template x-for="p in filteredPelatihans" :key="p.id">
                                    <option :value="p.id" x-text="p.name" :selected="p.id == selectedPelatihan">
                                    </option>
                                </template>
                            </select>
                            @error('pelatihan_id')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="mb-6">
                        <label for="graduation_year" class="block text-sm font-semibold text-gray-800 mb-2">Tahun
                            Lulus</label>
                        <input type="number" name="graduation_year" id="graduation_year" min="1900"
                            max="{{ date('Y') + 1 }}"
                            class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                            required value="{{ old('graduation_year') }}" placeholder="2024">
                        @error('graduation_year')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-semibold text-gray-800 mb-2">Alamat
                            Lengkap</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                            placeholder="Alamat domisili saat ini..." required>{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div class="mb-6">
                        <label for="phone_number" class="block text-sm font-semibold text-gray-800 mb-2">Nomor WhatsApp
                            / HP</label>
                        <input type="text" name="phone_number" id="phone_number"
                            class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                            required value="{{ old('phone_number') }}" placeholder="081234567890">
                        @error('phone_number')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div x-data="{ employmentStatus: '{{ old('employment_status', 'belum_bekerja') }}' }">
                        <!-- Status Bekerja -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-800 mb-3">Status Saat Ini</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label
                                    class="relative flex items-center p-4 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition"
                                    :class="employmentStatus === 'bekerja' ? 'border-primary bg-blue-50' : ''">
                                    <input type="radio" name="employment_status" value="bekerja"
                                        x-model="employmentStatus"
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary" required>
                                    <span class="ml-3 font-medium text-gray-700 text-sm">Telah Bekerja</span>
                                </label>
                                <label
                                    class="relative flex items-center p-4 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition"
                                    :class="employmentStatus === 'belum_bekerja' ? 'border-primary bg-blue-50' : ''">
                                    <input type="radio" name="employment_status" value="belum_bekerja"
                                        x-model="employmentStatus"
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <span class="ml-3 font-medium text-gray-700 text-sm">Belum Bekerja</span>
                                </label>
                            </div>
                            @error('employment_status')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Employment Details (Conditional) -->
                        <div x-show="employmentStatus === 'bekerja'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mb-6 p-6 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">

                            <div>
                                <label for="company_name" class="block text-sm font-semibold text-gray-800 mb-2">Nama
                                    Perusahaan</label>
                                <input type="text" name="company_name" id="company_name"
                                    class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                                    :required="employmentStatus === 'bekerja'" value="{{ old('company_name') }}"
                                    placeholder="PT. Nama Perusahaan">
                                @error('company_name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="position" class="block text-sm font-semibold text-gray-800 mb-2">Posisi /
                                    Jabatan</label>
                                <input type="text" name="position" id="position"
                                    class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                                    :required="employmentStatus === 'bekerja'" value="{{ old('position') }}"
                                    placeholder="Software Engineer">
                                @error('position')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Pesan / Motivasi
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-primary focus:ring-primary"
                            placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div class="mb-8" x-data="{ 
                        showModal: false, 
                        cropper: null,
                        fileName: '',
                        croppedImage: null,
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
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Foto Profil</label>

                        <div class="flex items-center gap-4">
                            <!-- Preview Box -->
                            <div
                                class="w-32 h-32 rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative group">
                                <template x-if="croppedImage">
                                    <img :src="croppedImage" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!croppedImage">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </template>
                                <label for="photo"
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer">
                                    <span class="text-white text-[10px] font-bold uppercase tracking-widest">Ganti
                                        Foto</span>
                                </label>
                            </div>

                            <div class="flex-1">
                                <label for="photo"
                                    class="inline-flex items-center px-6 py-3 bg-gray-50 text-gray-600 font-bold rounded-xl border border-gray-200 hover:border-primary/20 hover:bg-white transition-all cursor-pointer text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Pilih & Potong Foto
                                </label>
                                <p class="text-[10px] text-gray-400 mt-2 font-medium uppercase tracking-tight">Format:
                                    JPG, PNG • Max: 200KB • Rekomendasi: 1:1</p>
                                <p x-text="fileName" class="mt-1 text-xs text-primary font-bold"></p>
                            </div>
                        </div>

                        <input type="file" id="photo" accept="image/*" @change="handleFile" class="hidden">
                        <input type="hidden" name="cropped_image" id="cropped_image_input">

                        <!-- Cropping Modal -->
                        <div x-show="showModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                                    @click="showModal = false"></div>

                                <div
                                    class="relative bg-white rounded-3xl w-full max-w-4xl shadow-2xl overflow-hidden animate-zoom-in">
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
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('alumni.public') }}"
                            class="text-gray-600 hover:text-gray-800 font-medium transition">
                            &larr; Kembali
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-900/20">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
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

</body>

</html>