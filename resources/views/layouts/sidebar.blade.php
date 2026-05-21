<aside x-data="{ isMobile: window.innerWidth < 768 }" @resize.window="isMobile = window.innerWidth < 768"
    x-show="!isMobile || mobileOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" @click.away="if(isMobile) mobileOpen = false"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0F172A] border-r border-slate-800 shadow-[4px_0_24px_rgba(0,0,0,0.4)] flex flex-col md:relative md:w-64 md:translate-x-0 transition-transform duration-300 md:h-screen shrink-0"
    x-cloak>

    <!-- Logo Section -->
    <div class="h-20 flex items-center px-6 border-b border-white/5 bg-white/5 backdrop-blur-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group w-full">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-[0_0_15px_rgba(59,130,246,0.5)] group-hover:shadow-[0_0_25px_rgba(59,130,246,0.8)] transition-all duration-300">
                <img src="{{ asset('images/logo.png') }}" alt="BBPVP Logo" class="h-6 w-auto brightness-0 invert">
            </div>
            <div class="flex flex-col">
                <span
                    class="font-black text-white tracking-tight text-lg leading-none group-hover:text-blue-400 transition-colors">BBPVP</span>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.25em] mt-1">Semarang</span>
            </div>
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-8 custom-scrollbar">
        <!-- Main Section -->
        <div>
            <p class="px-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-[0.2em] mb-4">Main Menu</p>
            <nav class="space-y-1.5">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group overflow-hidden {{ request()->routeIs('dashboard') ? 'bg-blue-600/10 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    @if(request()->routeIs('dashboard'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,1)]">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-transparent pointer-events-none">
                        </div>
                    @endif
                    <svg class="w-5 h-5 transition-transform duration-300 {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'group-hover:text-blue-400 group-hover:scale-110' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="font-bold text-sm relative z-10">Dashboard</span>
                </a>

                <!-- Jurusan -->
                <a href="{{ route('admin.jurusans.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group overflow-hidden {{ request()->routeIs('admin.jurusans.*') ? 'bg-amber-500/10 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    @if(request()->routeIs('admin.jurusans.*'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500 shadow-[0_0_10px_rgba(245,158,11,1)]">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/20 to-transparent pointer-events-none">
                        </div>
                    @endif
                    <svg class="w-5 h-5 transition-transform duration-300 {{ request()->routeIs('admin.jurusans.*') ? 'text-amber-400' : 'group-hover:text-amber-400 group-hover:scale-110' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    <span class="font-bold text-sm relative z-10">Kelola Jurusan</span>
                </a>

                <!-- Alumni -->
                <a href="{{ route('admin.alumni.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group overflow-hidden {{ request()->routeIs('admin.alumni.*') ? 'bg-emerald-500/10 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    @if(request()->routeIs('admin.alumni.*'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,1)]">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-transparent pointer-events-none">
                        </div>
                    @endif
                    <svg class="w-5 h-5 transition-transform duration-300 {{ request()->routeIs('admin.alumni.*') ? 'text-emerald-400' : 'group-hover:text-emerald-400 group-hover:scale-110' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span class="font-bold text-sm relative z-10">Kelola Alumni</span>
                </a>
            </nav>
        </div>

        <!-- External Section -->
        <div>
            <div class="w-full h-px bg-white/5 mb-6"></div>
            <p class="px-4 text-[10px] font-extrabold text-slate-500 uppercase tracking-[0.2em] mb-4">Live View</p>
            <nav class="space-y-1">
                <a href="{{ route('alumni.public') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-indigo-500/10 hover:text-indigo-400 transition-all duration-300 group border border-transparent hover:border-indigo-500/20">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="font-bold text-sm">Lihat Web Publik</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- User Footer Section -->
    <div class="p-4 bg-slate-900/50 border-t border-white/5 backdrop-blur-md">
        <div
            class="rounded-xl p-3 flex items-center gap-3 bg-white/5 hover:bg-white/10 transition-colors border border-white/5 cursor-pointer">
            <div
                class="w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center font-black text-white text-xs shadow-inner">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</span>
                <span
                    class="text-[10px] font-medium text-slate-400 truncate uppercase tracking-tighter">Administrator</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit"
                    class="p-2 text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="mobileOpen" x-transition:opacity @click="mobileOpen = false"
    class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-40 md:hidden" style="display: none;" x-cloak></div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>