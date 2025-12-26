<header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 flex items-center justify-center">
                <img src="{{ asset('logo.png') }}"
                     alt="Logo Gravity Studio"
                     class="max-w-full max-h-full object-contain">
            </div>
            <div>
                <h1 class="text-lg font-extrabold tracking-tight text-gray-900 leading-none">Admin Panel</h1>
                <p class="text-[10px] text-gray-400 mt-1 font-bold uppercase tracking-wider">Gravity Photography</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="hidden md:inline">Dashboard</span>
            </a>
            <div class="hidden md:flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-2xl border border-gray-100">
                <div class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs font-bold uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
            @endauth
        </div>
    </div>
</header>