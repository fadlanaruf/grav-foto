<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Portofolio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Rock+Salt&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
            overflow-x: hidden;
        }
        .font-rock-salt { font-family: 'Rock Salt', cursive; }
        
        /* Glassmorphism Sidebar */
        .sidebar-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-right: 1px solid rgba(226, 232, 240, 0.6);
        }

        /* Smooth Gallery Hover */
        .gallery-item {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }
        .gallery-item:hover {
            transform: translateY(-10px) scale(1.02);
        }

        /* Mobile Touch Interactions */
        @media (max-width: 1024px) {
            .gallery-item:active {
                transform: scale(0.98);
                transition: transform 0.1s ease;
            }
            .gallery-item {
                transition: transform 0.2s ease;
            }
        }

        /* Mobile Filter Panel Animation */
        #mobile-filter-panel {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Mobile Header Animation */
        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slideInFromTop 0.3s ease-out;
        }

        /* Enhanced Mobile Responsiveness */
        @media (max-width: 640px) {
            .gallery-item {
                border-radius: 2rem;
            }
            .gallery-overlay {
                padding: 1.5rem;
            }
            .gallery-overlay h4 {
                font-size: 1.25rem;
            }
        }
        .gallery-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
        }

        /* Glow Background */
        .glow-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
        }
        .glow-1 {
            position: absolute;
            top: -10%; right: -5%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.07), transparent 70%);
            filter: blur(80px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] antialiased">
    <div class="glow-bg">
        <div class="glow-1"></div>
    </div>

    <!-- ================= HEADER ================= -->
    <header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- KIRI: LOGO -->
            <a href="/" class="flex items-center order-1">
                <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Logo">
            </a>

            <!-- TENGAH: MENU DESKTOP -->
            <nav class="hidden md:flex justify-center space-x-10 text-sm font-semibold text-gray-600 order-2">
                <a href="/" class="hover:text-indigo-600 transition">Beranda</a>
                <a href="{{ route('packages.index') }}" class="hover:text-indigo-600 transition">Paket</a>
                <a href="{{ route('galeri') }}" class="text-indigo-600">Galeri</a>
                <a href="/#tracking" class="hover:text-indigo-600 transition">Lacak Reservasi</a>
                <a href="https://wa.me/62xxxxxxxx" class="hover:text-indigo-600 transition">Hubungi</a>
            </nav>

            <!-- KANAN: PROFIL + TOGGLE MOBILE -->
            <div class="flex items-center gap-4 order-3">

                @auth
                <!-- PROFIL DESKTOP -->
                <div class="relative hidden md:block">
                    <button id="profile-toggle"
                            class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600
                                   flex items-center justify-center hover:bg-indigo-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>

                    <!-- DROPDOWN DESKTOP -->
                    <div id="profile-menu" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 mb-1">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akun Saya</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        </div>

                        <div class="p-1">
                            <a href="{{ route('reservations.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">Riwayat Reservasi</span>
                            </a>

                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">Pengaturan Profil</span>
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form action="{{ route('admin.logout') }}" method="POST" class="p-1">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-600 rounded-xl hover:bg-red-50 transition group">
                                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-red-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @endauth

                <!-- TOGGLE MOBILE -->
                <button id="mobile-toggle" class="md:hidden w-10 h-10 flex items-center justify-center hover:bg-gray-100 rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- MOBILE DROPDOWN -->
        <div id="mobile-dropdown" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden top-full">
            <div class="p-1">
                <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Beranda</span>
                </a>

                <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Paket</span>
                </a>

                <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-indigo-600 rounded-xl hover:bg-indigo-50 transition group">
                    <div class="p-2 bg-indigo-50 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Galeri</span>
                </a>

                <a href="/#tracking" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Lacak Reservasi</span>
                </a>

                <a href="https://wa.me/62xxxxxxxx" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    </div>
                    <span class="font-semibold">Hubungi</span>
                </a>

                @auth
                <div class="border-t border-gray-100 my-1"></div>

                <a href="{{ route('reservations.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Riwayat Reservasi</span>
                </a>

                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                    <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Pengaturan Profil</span>
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form action="{{ route('admin.logout') }}" method="POST" class="p-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-600 rounded-xl hover:bg-red-50 transition group">
                        <div class="p-2 bg-red-50 rounded-lg group-hover:bg-red-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <span class="font-semibold">Keluar</span>
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        
        <aside class="w-72 sidebar-glass fixed z-20 hidden lg:block overflow-y-auto" style="top: 80px; height: calc(100vh - 80px);">

            <div class="p-10 flex flex-col h-full">

                <div class="flex-1">
                    <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-8 px-4">Kategori Karya</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="category-link flex items-center px-5 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-100 transition-all uppercase" data-category="all">
                                Semua Karya
                            </a>
                        </li>
                        @php $categories = $albums->pluck('category')->filter()->unique()->sort(); @endphp
                        @foreach($categories as $cat)
                        <li>
                            <a href="#" class="category-link flex items-center px-5 py-4 text-gray-500 hover:text-indigo-600 hover:bg-white rounded-2xl font-bold text-sm transition-all group uppercase" data-category="{{ $cat }}">
                                <span class="w-2 h-2 rounded-full bg-gray-200 mr-4 group-hover:bg-indigo-600 group-hover:scale-125 transition-all"></span>
                                {{ $cat }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="pt-10 border-t border-gray-100">
                    <a href="{{ route('reservations.create') }}" class="block text-center py-5 bg-gray-900 text-white rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl shadow-gray-200 hover:bg-black transition-all active:scale-95">
                        Booking Sekarang
                    </a>
                </div>
            </div>
        </aside>

        <main class="flex-1 lg:ml-72 p-8 lg:p-16 pt-32 lg:pt-34">
            
            <div class="lg:hidden fixed top-20 left-4 right-4 z-30 bg-white/95 backdrop-blur-md rounded-3xl p-4 shadow-xl border border-gray-200/50 animate-slide-in">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-linear-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <h2 class="font-bold text-gray-900 text-sm">Galeri Foto</h2>
                            <p class="text-xs text-gray-500">Koleksi {{ date('Y') }}</p>
                        </div>
                    </div>
                    <button id="mobile-filter-toggle" class="w-11 h-11 flex items-center justify-center bg-linear-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 rounded-2xl shadow-lg text-white transition-all duration-200 hover:scale-105 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- MOBILE FILTER PANEL -->
            <div id="mobile-filter-panel" class="lg:hidden fixed inset-x-0 top-0 z-40 bg-white/95 backdrop-blur-lg border-b border-gray-200 transform -translate-y-full transition-transform duration-300 ease-out">
                <div class="p-6 pt-24">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Filter Kategori</h3>
                        <button id="close-mobile-filter" class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-3">
                        <a href="#" class="category-link flex items-center px-4 py-3 bg-indigo-600 text-white rounded-xl font-semibold text-sm shadow-lg transition-all uppercase" data-category="all">
                            <span class="w-3 h-3 rounded-full bg-white/30 mr-3"></span>
                            Semua Karya
                        </a>
                        @php $categories = $albums->pluck('category')->filter()->unique()->sort(); @endphp
                        @foreach($categories as $cat)
                        <a href="#" class="category-link flex items-center px-4 py-3 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl font-semibold text-sm transition-all group uppercase" data-category="{{ $cat }}">
                            <span class="w-3 h-3 rounded-full bg-gray-300 mr-3 group-hover:bg-indigo-600 group-hover:scale-110 transition-all"></span>
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <header class="mb-16 text-center lg:text-left">
                <h1 class="font-rock-salt text-3xl md:text-4xl lg:text-5xl text-gray-900 mb-6 leading-relaxed uppercase bg-linear-to-r from-gray-900 via-indigo-800 to-gray-900 bg-clip-text">
                    Our Masterpieces
                </h1>
                <div class="flex items-center justify-center lg:justify-start gap-4">
                    <div class="w-16 h-1.5 bg-linear-to-r from-indigo-600 to-purple-600 rounded-full"></div>
                    <p class="text-gray-400 font-bold text-sm uppercase tracking-widest">Koleksi Terkini {{ date('Y') }}</p>
                </div>
                
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 xl:gap-10">
                @forelse($albums as $album)
                    @php
                        $img = null;
                        if ($album->cover_image) {
                            $img = asset('storage/'.$album->cover_image);
                        } elseif ($album->photos->first()) {
                            $img = asset('storage/'.$album->photos->first()->photo_path);
                        } else {
                            $img = 'https://via.placeholder.com/800x1000?text=No+Image';
                        }
                    @endphp

                    <div class="gallery-item group relative aspect-4/5 overflow-hidden rounded-[3rem] bg-gray-200 cursor-pointer shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10" 
                         data-category="{{ $album->category ?? 'Umum' }}"
                         data-album-id="{{ $album->id }}"
                         data-album-title="{{ $album->title }}"
                         data-album-description="{{ $album->description }}"
                         data-photos="{{ $album->photos->map(function($photo) { return ['path' => asset('storage/'.$photo->photo_path), 'caption' => $photo->caption]; })->toJson() }}">
                        <img src="{{ $img }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        <div class="gallery-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500 p-10 flex flex-col justify-end">
                            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-3">{{ $album->category ?? 'Umum' }}</span>
                            <h4 class="text-white font-black text-2xl tracking-tight leading-none mb-4 uppercase">{{ $album->title }}</h4>
                            <div class="w-10 h-1 bg-white/30 rounded-full group-hover:w-20 transition-all duration-700"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 uppercase font-bold">Belum ada album yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="mt-16 lg:mt-24 flex justify-center pb-10">
                <nav class="flex items-center gap-2 lg:gap-3 p-2 lg:p-3 bg-white/80 backdrop-blur-sm rounded-2xl lg:rounded-3xl shadow-lg border border-gray-100">
                    <button class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 transition-all text-sm lg:text-base">←</button>
                    <span class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl bg-indigo-600 text-white font-black text-xs lg:text-sm shadow-xl shadow-indigo-100">1</span>
                    <span class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl text-gray-400 font-bold text-xs lg:text-sm hover:bg-gray-50 cursor-pointer transition-all">2</span>
                    <span class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl text-gray-400 font-bold text-xs lg:text-sm hover:bg-gray-50 cursor-pointer transition-all">3</span>
                    <button class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-xl lg:rounded-2xl text-indigo-600 hover:bg-indigo-50 transition-all text-sm lg:text-base">→</button>
                </nav>
            </div>

        </main>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Logika Filter Kategori & Mobile Filter
    const categoryLinks = document.querySelectorAll('.category-link');
    const mobileFilterPanel = document.getElementById('mobile-filter-panel');
    const mobileFilterToggle = document.getElementById('mobile-filter-toggle');
    const closeMobileFilter = document.getElementById('close-mobile-filter');

    // Toggle Mobile Filter Panel
    if (mobileFilterToggle && mobileFilterPanel) {
        mobileFilterToggle.addEventListener('click', () => {
            mobileFilterPanel.classList.remove('-translate-y-full');
        });
    }

    if (closeMobileFilter && mobileFilterPanel) {
        closeMobileFilter.addEventListener('click', () => {
            mobileFilterPanel.classList.add('-translate-y-full');
        });
    }

    // Filter Logic
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            
            // Filter Gallery Items
            document.querySelectorAll('.gallery-item').forEach(item => {
                const itemCat = item.getAttribute('data-category');
                item.style.display = (category === 'all' || itemCat === category) ? '' : 'none';
            });

            // Update Active State (Sync Desktop & Mobile)
            categoryLinks.forEach(l => {
                // Reset to inactive state
                l.classList.remove('bg-indigo-600', 'text-white', 'shadow-xl', 'shadow-indigo-100');
                l.classList.add('text-gray-500', 'hover:text-indigo-600', 'hover:bg-white');
                
                // Set active state if matches category
                if (l.getAttribute('data-category') === category) {
                    l.classList.remove('text-gray-500', 'hover:text-indigo-600', 'hover:bg-white');
                    l.classList.add('bg-indigo-600', 'text-white', 'shadow-xl', 'shadow-indigo-100');
                }
            });

            // Close mobile filter if open
            if (mobileFilterPanel && !mobileFilterPanel.classList.contains('-translate-y-full')) {
                mobileFilterPanel.classList.add('-translate-y-full');
            }
        });
    });

    // 2. MODAL LOGIC (FIXED)
    const modal = document.getElementById('album-modal');
    const modalImg = document.getElementById('modal-image-display');
    const closeBtn = document.getElementById('close-modal-btn');
    const prevBtn = document.getElementById('prev-photo-btn');
    const nextBtn = document.getElementById('next-photo-btn');
    
    let albumData = [];
    let activeIndex = 0;

    // Open Modal
    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function() {
            albumData = JSON.parse(this.dataset.photos);
            if (albumData.length === 0) return alert('Tidak ada foto.');

            activeIndex = 0;
            document.getElementById('modal-album-title').textContent = this.dataset.albumTitle;
            document.getElementById('modal-album-description').textContent = this.dataset.albumDescription;
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                renderPhoto();
            }, 10);
            document.body.style.overflow = 'hidden';
        });
    });

    function renderPhoto() {
        const photo = albumData[activeIndex];
        
        // Animasi keluar
        modalImg.classList.remove('scale-100', 'opacity-100');
        modalImg.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modalImg.src = photo.path;
            document.getElementById('current-photo-num').textContent = activeIndex + 1;
            document.getElementById('total-photos-num').textContent = albumData.length;
            document.getElementById('modal-caption-area').querySelector('p').textContent = photo.caption || "";

            // Animasi masuk saat loading selesai
            modalImg.onload = () => {
                modalImg.classList.remove('scale-95', 'opacity-0');
                modalImg.classList.add('scale-100', 'opacity-100');
            };

            // Update Nav
            prevBtn.disabled = activeIndex === 0;
            nextBtn.disabled = activeIndex === albumData.length - 1;
        }, 200);
    }

    function closeAlbum() {
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modalImg.src = "";
            document.body.style.overflow = '';
        }, 300);
    }

    // Event Listeners (Gunakan listener spesifik agar tidak bentrok)
    closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        closeAlbum();
    });

    nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (activeIndex < albumData.length - 1) {
            activeIndex++;
            renderPhoto();
        }
    });

    prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (activeIndex > 0) {
            activeIndex--;
            renderPhoto();
        }
    });

    // Keyboard Nav
    document.addEventListener('keydown', (e) => {
        if (modal.classList.contains('hidden')) return;
        if (e.key === "Escape") closeAlbum();
        if (e.key === "ArrowRight") nextBtn.click();
        if (e.key === "ArrowLeft") prevBtn.click();
    });

    // Logika Mobile Menu (Pindahkan agar rapi)
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileDropdown = document.getElementById('mobile-dropdown');
    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            mobileDropdown.classList.toggle('hidden');
        });
    }
});
</script>

    <!-- Album Modal -->
    <div id="album-modal" class="fixed inset-0 z-100 hidden opacity-0 transition-all duration-300 ease-in-out">
    <div class="absolute inset-0 bg-black/95 backdrop-blur-xl transition-opacity"></div>
    
    <div class="relative flex flex-col h-full w-full">
        <div class="relative z-10 flex items-center justify-between px-6 py-6 lg:px-12 pointer-events-none">
            <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-3xl border border-white/10 pointer-events-auto">
                <h3 id="modal-album-title" class="text-white font-black text-lg lg:text-xl uppercase tracking-wider leading-none"></h3>
                <p id="modal-album-description" class="text-white/60 text-[10px] lg:text-xs mt-1 truncate max-w-[200px] lg:max-w-md"></p>
            </div>

            <button id="close-modal-btn" class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center bg-white text-black hover:bg-red-600 hover:text-white rounded-full transition-all duration-300 shadow-2xl pointer-events-auto active:scale-90 group">
                <svg class="w-6 h-6 transform group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex-1 relative flex items-center justify-center p-4 lg:p-10 overflow-hidden">
            <button id="prev-photo-btn" class="absolute left-4 lg:left-10 z-20 w-14 h-14 bg-white/10 hover:bg-white text-white hover:text-black rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-md border border-white/10 disabled:hidden">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <div class="relative max-w-7xl w-full h-full flex flex-col items-center justify-center group">
                <img id="modal-image-display" src="" alt="" 
                     class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-all duration-500 transform scale-95 opacity-0">
                
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase border border-white/10">
                    <span id="current-photo-num">1</span> / <span id="total-photos-num">1</span>
                </div>
            </div>

            <button id="next-photo-btn" class="absolute right-4 lg:right-10 z-20 w-14 h-14 bg-white/10 hover:bg-white text-white hover:text-black rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-md border border-white/10 disabled:hidden">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>

        <div id="modal-caption-area" class="relative z-10 px-6 py-10 lg:px-20 text-center">
            <p class="text-white/80 text-sm lg:text-base font-medium max-w-3xl mx-auto italic"></p>
        </div>
    </div>
</div>

</body>
</html>