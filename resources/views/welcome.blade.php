<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravity Studio – Reservasi Online</title>
    @vite('resources/css/app.css')

    <style>
        .hero-background {
            background-image: url('https://www.picturecorrect.com/wp-content/uploads/2014/05/levitation-photo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        body {
            padding-top: 64px;
        }

        /* CSS Kustom untuk Galeri Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 kolom di mobile/default */
            grid-auto-rows: minmax(150px, auto);
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                grid-auto-rows: minmax(150px, auto);
            }
            .item-2-span {
                grid-row: span 2 / span 2;
            }
            .item-1-span {
                grid-column: span 2 / span 2; 
            }
            .item-5-span {
                grid-column: span 2 / span 2; 
            }
        }
    </style>
</head>
<body class="bg-white text-gray-800">
<!-- HEADER -->
<header class="fixed top-0 w-full z-30 backdrop-blur-xl bg-white/70 shadow-sm border-b border-white/40">
    <div class="max-w-7xl mx-auto px-6 py-3">

        <div class="flex items-center justify-between">

            <a href="/" class="flex items-center space-x-2">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                    G
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Gravity<span class="text-indigo-600">Studio</span>
                </h1>
            </a>

            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">

                <a href="http://wa.me/62128281212871"
                    class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>Hubungi</span>
                </a>

                @if (Auth::check())
                    <div class="flex items-center gap-3">
                        <a href="{{ route('reservations.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                            Riwayat Reservasi
                        </a>
                        <p class="px-4 py-2 bg-indigo-600 text-white rounded-xl">
                            {{ Auth::user()->name }}
                        </p>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition">
                        Masuk
                    </a>
                @endif
            </nav>

            <button id="mobile-menu-button" class="md:hidden text-gray-900 focus:outline-none transition">
                <svg id="icon-open" class="w-7 h-7 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg id="icon-close" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

        <!-- MOBILE NAV -->
        <div id="mobile-nav" 
            class="hidden md:hidden mt-3 bg-white/90 rounded-xl px-5 py-4 space-y-4 shadow-xl border border-gray-100
                   transform origin-top transition-all duration-300 scale-y-0 opacity-0">

            <a href="tel:08123456789" class="flex items-center space-x-3 text-gray-700 hover:text-indigo-600 transition font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Hubungi</span>
            </a>

            <a href="{{ route('login') }}"
                class="block text-center px-5 py-2 text-indigo-600 border border-indigo-600 rounded-xl hover:bg-indigo-50 transition font-semibold">
                Masuk
            </a>
        </div>
    </div>
</header>

<section class="hero-background relative h-[500px] flex items-center justify-center pt-0">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    
    <div class="relative text-center max-w-7xl mx-auto px-4 z-10"> 
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-3">
            Abadikan Momen Terbaikmu
        </h2>

        <p class="text-gray-200 text-lg mb-10">
            Studio foto profesional dengan layanan premium.
        </p>
        
        <div class="flex flex-col md:flex-row bg-white p-3 rounded-2xl shadow-2xl items-stretch max-w-4xl mx-auto">
            
            <div class="flex-1 p-3 text-left">
                <label for="layanan" class="text-xs font-semibold text-gray-500 block">Layanan</label>
                <input type="text" id="layanan" placeholder="Pilih jenis sesi foto"
                    class="w-full text-gray-900 font-medium border-none focus:ring-0 p-0"/>
            </div>

            <div class="flex-1 p-3 text-left border-t md:border-t-0 md:border-l border-gray-200">
                <label for="tanggal" class="text-xs font-semibold text-gray-500 block">Tanggal</label>
                <input type="date" id="tanggal" value="2025-12-15"
                    class="w-full text-gray-900 font-medium border-none focus:ring-0 p-0"/>
            </div>

            <div class="flex-1 p-3 text-left border-t md:border-t-0 md:border-l border-gray-200">
                <label for="waktu" class="text-xs font-semibold text-gray-500 block">Waktu</label>
                <input type="time" id="waktu" value="10:00"
                    class="w-full text-gray-900 font-medium border-none focus:ring-0 p-0"/>
            </div>
            
            <a href="{{ Auth::check() ? route('reservations.create') : route('login') }}" 
               class="mt-3 md:mt-0 w-full md:w-auto p-4 bg-indigo-600 text-white rounded-xl md:rounded-l-none md:rounded-r-xl hover:bg-indigo-700 transition flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<section id="tracking" class="px-6 py-16 bg-gray-50 border-b border-gray-100">
    <div class="max-w-xl mx-auto text-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Lacak Status Reservasi Anda</h3>
        <p class="text-gray-600 mb-6">Masukkan ID Reservasi Anda untuk melihat status pemesanan, jadwal, dan progres edit foto.</p>

        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 bg-white p-2 rounded-xl shadow-lg border border-gray-200">
            <form action="{{ route('reservations.track') }}" method="POST" class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 w-full">
                @csrf
                <div class="flex-1">
                    <input type="text" name="code" placeholder="Contoh: GS-20251215-001" 
                           class="w-full px-4 py-3 border-none focus:ring-indigo-500 focus:border-indigo-500 rounded-lg text-gray-700 font-medium"
                           aria-label="Masukkan ID Reservasi" required>
                </div>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition font-semibold shrink-0">
                    Cek Status
                </button>
            </form>
        </div>
        @if(session('error'))
            <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>
</section>

<section id="galeri" class="px-6 py-16">
    <h3 class="text-3xl font-bold text-center mb-10">Galeri</h3>

    <div class="gallery-grid max-w-3xl mx-auto"> 
        
        <div class="group relative overflow-hidden rounded-2xl shadow-lg item-1-span cursor-pointer">
            <img src="https://parentalk.id/wp-content/uploads/2023/09/shutterstock_1293334711-1.jpg"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white text-2xl font-semibold">
                Prewedding
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg item-2-span cursor-pointer">
            <img src="https://www.bcalife.co.id/storage/articles/share/wujudkan-pernikahan-sakral-dan-anti-boros-dengan-konsep-intimate-wedding-1718346697.png"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white text-2xl font-semibold">
                Wedding
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg item-1-span cursor-pointer">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1U2IQI2L5H4hycME7jiaKdcDic3CA1aWL6Q&s"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white text-2xl font-semibold">
                Model
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEc1eG03ZEcwEXXImBZktn5xslJ1DwBeVl5g&s"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white text-2xl font-semibold">
                Keluarga
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg item-5-span cursor-pointer">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRs439moyqxqMXmN8byee6BZHGagAoMQZltcg&s"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition"></div>
            <div class="absolute inset-0 flex items-center justify-center text-white text-2xl font-semibold">
                Wisuda
            </div>
        </div>
    </div>
</section>

<footer id="kontak" class="py-10 bg-gray-900 text-gray-300 text-center">
    <p>© 2025 GravityStudio. Semua hak dilindungi.</p>
</footer>

<script>
    const btn = document.getElementById("mobile-menu-button");
    const menu = document.getElementById("mobile-menu");
    const iconOpen = document.getElementById("icon-open");
    const iconClose = document.getElementById("icon-close");

    btn.onclick = () => {
        const isHidden = menu.classList.contains("hidden");

        if (isHidden) {
            menu.classList.remove("hidden");
            setTimeout(() => {
                menu.classList.remove("scale-y-0", "opacity-0");
                menu.classList.add("scale-y-100", "opacity-100");
            }, 10);

            iconOpen.classList.add("hidden");
            iconClose.classList.remove("hidden");

        } else {
            menu.classList.add("scale-y-0", "opacity-0");
            menu.classList.remove("scale-y-100", "opacity-100");

            iconOpen.classList.remove("hidden");
            iconClose.classList.add("hidden");

            setTimeout(() => menu.classList.add("hidden"), 200);
        }
    };
</script>


</body>
</html>