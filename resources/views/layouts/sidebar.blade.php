<div x-data="{ open: true, mobileOpen: false }" :class="{'w-64': open, 'w-20': !open}"
    class="flex flex-col h-screen bg-white transition-all duration-300 ease-in-out border-r border-gray-200 shadow-sm hidden md:flex sticky top-0 z-40">

    <!-- Header / Logo Area -->
    <div class="flex items-center justify-between h-20 px-4 border-b border-gray-100">
        <div class="flex items-center gap-3 overflow-hidden">
            {{-- Logo Removed --}}
        </div>

        <!-- Toggle Button (Hamburger) -->
        <button @click="open = !open"
            class="p-2 rounded-xl text-gray-500 hover:bg-gray-100 hover:text-primary transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/10">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h10M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-2 custom-scrollbar">

        <!-- Generic Nav Item Component (Inline for simplicity or you could extract) -->
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group relative
           {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-md shadow-blue-900/20' : 'text-gray-600 hover:bg-blue-50 hover:text-primary' }}">

            <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>

            <span x-show="open" x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 translate-x-[-5px]"
                x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 font-medium whitespace-nowrap">
                Dashboard
            </span>

            {{-- Tooltip for collapsed state --}}
            <div x-show="!open"
                class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap z-50">
                Dashboard
            </div>
        </a>

        {{-- Manage Jurusan --}}
        <a href="{{ route('admin.jurusans.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group relative
           {{ request()->routeIs('admin.jurusans.*') ? 'bg-primary text-white shadow-md shadow-blue-900/20' : 'text-gray-600 hover:bg-blue-50 hover:text-primary' }}">

            <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>

            <span x-show="open" x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 translate-x-[-5px]"
                x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 font-medium whitespace-nowrap">
                Manage Jurusan
            </span>

            <div x-show="!open"
                class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap z-50">
                Manage Jurusan
            </div>
        </a>

        {{-- Manage Alumni --}}
        <a href="{{ route('admin.alumni.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group relative
           {{ request()->routeIs('admin.alumni.*') ? 'bg-primary text-white shadow-md shadow-blue-900/20' : 'text-gray-600 hover:bg-blue-50 hover:text-primary' }}">

            <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>

            <span x-show="open" x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 translate-x-[-5px]"
                x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 font-medium whitespace-nowrap">
                Manage Alumni
            </span>

            <div x-show="!open"
                class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap z-50">
                Manage Alumni
            </div>
        </a>

        {{-- Lihat Web Publik --}}
        <a href="{{ route('alumni.public') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group relative text-gray-600 hover:bg-blue-50 hover:text-primary">

            <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>

            <span x-show="open" x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 translate-x-[-5px]"
                x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 font-medium whitespace-nowrap">
                Lihat Web Publik
            </span>

            <div x-show="!open"
                class="absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 whitespace-nowrap z-50">
                Lihat Web Publik
            </div>
        </a>

    </nav>

    <!-- Footer Area -->
    <div class="p-3 border-t border-gray-100 flex flex-col gap-2">
    </div>

</div>

{{-- Mobile Sidebar Overlay --}}
<div x-show="mobileOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-40 md:hidden glass"
    @click="mobileOpen = false"></div>

{{-- Mobile Sidebar --}}
<div x-show="mobileOpen" x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 w-64 bg-white z-50 shadow-xl overflow-y-auto md:hidden">

    <div class="flex items-center justify-between h-20 px-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <span class="font-bold text-lg text-primary">Admin Panel</span>
        </div>
        <button @click="mobileOpen = false" class="text-gray-500 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.jurusans.index') }}"
            class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.jurusans.*') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Manage Jurusan
        </a>

        <a href="{{ route('admin.alumni.index') }}"
            class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.alumni.*') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Manage Alumni
        </a>

        <div class="pt-4 mt-4 border-t border-gray-100">
            <a href="{{ route('alumni.public') }}"
                class="flex items-center px-4 py-3 text-sm font-medium text-gray-500 hover:text-primary">
                Lihat Web Publik
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="flex items-center px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl">
                    Log Out
                </a>
            </form>
        </div>
    </nav>
</div>