<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
        <p class="text-gray-500 text-sm mt-1">Bergabunglah dengan jaringan alumni BBPVP</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-medium" />
            <x-text-input id="name"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-primary focus:ring-primary" type="text"
                name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-primary focus:ring-primary"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-primary focus:ring-primary"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full rounded-xl border-gray-200 focus:border-primary focus:ring-primary"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full py-3 bg-primary text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-900/20">
                {{ __('Daftar') }}
            </button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary font-semibold hover:text-blue-700">Masuk</a>
        </div>
    </form>
</x-guest-layout>