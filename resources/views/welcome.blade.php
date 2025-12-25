<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravity Photography</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .hero-background {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://orangeuntirta.com/wp-content/uploads/2025/06/Potret-Sejarah-Fotografi-Indonesia-Jejak-Visual-yang-Tak-Terhapus.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Gallery Masonry Grid */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .gallery-item-tall { grid-row: span 2; }
    </style>
</head>
<body class="bg-white text-gray-900">

<!-- ================= HEADER ================= -->
<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 h-20 grid grid-cols-3 items-center">

        <!-- KIRI: LOGO -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Logo">
        </a>

        <!-- TENGAH: MENU DESKTOP -->
        <nav class="hidden md:flex justify-center space-x-10 text-sm font-semibold text-gray-600">
            <a href="#" class="hover:text-indigo-600 transition">Beranda</a>
            <a href="#tracking" class="hover:text-indigo-600 transition">Lacak Reservasi</a>
            <a href="https://wa.me/62xxxxxxxx" class="hover:text-indigo-600 transition">Hubungi</a>
        </nav>

        <!-- KANAN: PROFIL + HAMBURGER -->
        <div class="flex items-center justify-end gap-4">

            @auth
            <!-- PROFIL -->
            <div class="relative">
                <button id="profile-toggle"
                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600
                               flex items-center justify-center hover:bg-indigo-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>

                <!-- DROPDOWN -->
                <div id="profile-menu" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 mb-1">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Akun Saya</p>
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
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Profil Saya</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-500 rounded-xl hover:bg-red-50 transition group">
                                <div class="p-2 bg-red-50 rounded-lg group-hover:bg-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @else
            <!-- TOMBOL MASUK (GUEST) -->
            <a href="{{ route('login') }}"
               class="px-6 py-2.5 rounded-full bg-indigo-600 text-white text-sm font-bold
                      hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                Masuk
            </a>
            @endauth

            <!-- HAMBURGER MOBILE -->
            <button id="menu-toggle" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- MENU MOBILE -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <nav class="flex flex-col px-6 py-4 space-y-4 text-sm font-semibold text-gray-600">
            <a href="#" class="hover:text-indigo-600">Beranda</a>
            <a href="#tracking" class="hover:text-indigo-600">Lacak Reservasi</a>
            <a href="https://wa.me/62xxxxxxxx" class="hover:text-indigo-600">Hubungi</a>
        </nav>
    </div>
</header>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const profileToggle = document.getElementById('profile-toggle');
    const profileMenu = document.getElementById('profile-menu');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (profileToggle) {
        profileToggle.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });
    }

    document.addEventListener('click', (e) => {
        if (profileMenu && !profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });
});
</script>

<script>
function handleReservation() {
    @auth
        window.location.href = '{{ route("reservations.create") }}';
    @else
        alert('Silakan login terlebih dahulu untuk melakukan reservasi.');
        window.location.href = '{{ route("login") }}';
    @endauth
}
</script>

<section class="hero-background h-[600px] flex items-center pt-20">
    <div class="max-w-7xl mx-auto px-6 w-full text-center text-white">
        <h1 class="text-5xl md:text-5xl mb-4 tracking-tight" style="font-family: 'Rock Salt', cursive;">Come and Get Your Moments</h1>
        <p class="text-lg opacity-90 mb-12">Studio foto profesional dengan layanan premium dan hasil berkualitas tinggi.</p>
        
        <form action="{{ route('reservations.create') }}" method="GET" class="bg-white p-2 rounded-2xl shadow-2xl max-w-4xl mx-auto flex flex-col md:row text-gray-800">
            <div class="flex flex-col md:flex-row flex-1">
                <div class="flex-1 px-6 py-3 text-left border-r border-gray-100">
                    <label class="text-[10px] uppercase tracking-wider font-bold text-gray-400">Layanan</label>
                    <select name="photo_package_id" class="w-full font-semibold bg-transparent focus:outline-none">
                        <option value="">Pilih Layanan</option>
                        @foreach(\App\Models\PhotoPackage::where('is_active', true)->get() as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 px-6 py-3 text-left border-r border-gray-100">
                    <label class="text-[10px] uppercase tracking-wider font-bold text-gray-400">Pilih Tanggal</label>
                    <input type="date" name="photo_date" class="w-full font-semibold bg-transparent focus:outline-none" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
                <div class="w-32 px-6 py-3 text-left">
                    <label class="text-[10px] uppercase tracking-wider font-bold text-gray-400">Waktu</label>
                    <input type="time" name="photo_time" class="w-full font-semibold bg-transparent focus:outline-none">
                </div>
            </div>
            <button onclick="handleReservation()" type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl hover:bg-indigo-700 font-bold transition">Reservasi Sekarang</button>
        </form>
    </div>
</section>

<section class="py-24 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <h2 class="text-3xl font-extrabold mb-4">Lacak Status Reservasi</h2>
        <p class="text-gray-500 mb-8">Masukkan ID Reservasi untuk melihat status pemesanan, jadwal, dan progres foto.</p>
        <form action="{{ route('reservations.track') }}" method="POST" class="flex gap-2 p-2 bg-white rounded-2xl shadow-sm border border-gray-200">
            @csrf
            <input type="text" name="code" placeholder="Contoh: GS-20251215-001" class="flex-1 px-4 focus:outline-none font-medium" required>
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">Cek Status</button>
        </form>
        <div class="mt-4 flex justify-center gap-6 text-xs font-semibold text-gray-400 uppercase">
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-yellow-400 rounded-full"></span> Menunggu Konfirmasi</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-blue-400 rounded-full"></span> Proses Edit</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-green-400 rounded-full"></span> Selesai</span>
        </div>
    </div>
</section>

<section class="py-24 max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-extrabold mb-2">Galeri Karya Kami</h2>
        <p class="text-gray-500">Lihat hasil jepretan terbaik dari berbagai momen yang telah kami abadikan.</p>
    </div>

    <div class="gallery-container">
        <div class="gallery-item-tall bg-gray-200 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://warnaindonesiaphoto.com/wp-content/uploads/2021/07/PAKET-PREWEDDING-MURAH-2.jpg" class="w-full h-full object-cover">
        </div>
        <div class="bg-gray-200 rounded-3xl overflow-hidden shadow-lg h-80">
            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover">
        </div>
        <div class="bg-gray-200 rounded-3xl overflow-hidden shadow-lg h-80">
            <img src="https://foto.co.id/wp-content/uploads/2013/09/IMG_7992.jpg" class="w-full h-full object-cover">
        </div>
        <div class="bg-gray-200 rounded-3xl overflow-hidden shadow-lg h-80">
            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover">
        </div>
        <div class="gallery-item-tall bg-gray-200 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://www.prasetiyamulya.ac.id/wp-content/uploads/2023/11/Fakta-Menarik-Momen-Wisuda-Menjadi-Sebuah-Langkah-Awal-Membangun-Karir-Profesional.jpg" class="w-full h-full object-cover">
        </div>
    </div>
    
    <div class="mt-12 text-center">
    <a href="{{ url('/galeri') }}" 
       class="inline-block px-8 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-black transition-all active:scale-95 shadow-lg shadow-gray-200">
        Lihat Lebih Banyak
    </a>
</div>
</section>

<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold mb-2">Layanan Kami</h2>
            <p class="text-gray-500">Berbagai paket foto yang disesuaikan dengan kebutuhan Anda.</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <h4 class="text-xl font-bold mb-2">Prewedding</h4>
                <p class="text-sm text-gray-500 mb-6">Abadikan kisah kasih Anda dengan tema romantis.</p>
                <p class="text-indigo-600 font-extrabold text-lg">Rp 2.5jt</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <h4 class="text-xl font-bold mb-2">Keluarga</h4>
                <p class="text-sm text-gray-500 mb-6">Momen hangat bersama keluarga tercinta.</p>
                <p class="text-indigo-600 font-extrabold text-lg">Rp 1.5jt</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm10 3h-8v-2h8v2zm0-4h-8v-2h8v2z"/></svg>
                </div>
                <h4 class="text-xl font-bold mb-2">Produk</h4>
                <p class="text-sm text-gray-500 mb-6">Tingkatkan penjualan dengan foto katalog profesional.</p>
                <p class="text-indigo-600 font-extrabold text-lg">Rp 800rb</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                <div class="w-12 h-12 bg-pink-50 rounded-2xl flex items-center justify-center text-pink-600 mb-6">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <h4 class="text-xl font-bold mb-2">Potret</h4>
                <p class="text-sm text-gray-500 mb-6">Sesi personal untuk kebutuhan branding & CV.</p>
                <p class="text-indigo-600 font-extrabold text-lg">Rp 1.2jt</p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-indigo-600 rounded-[40px] p-12 text-center text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-4xl font-extrabold mb-4">Siap Memulai Sesi Foto?</h2>
            <p class="opacity-80 mb-8 max-w-xl mx-auto">Reservasi sekarang dan dapatkan diskon 20% untuk pemesanan pertama Anda melalui website.</p>
            <div class="flex justify-center gap-4">
                <button onclick="handleReservation()" class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold hover:bg-gray-100 transition">Reservasi Sekarang</button>
                <button class="bg-indigo-500 text-white px-8 py-4 rounded-2xl font-bold border border-white/20 hover:bg-indigo-400 transition">Hubungi Kami</button>
            </div>
        </div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full"></div>
    </div>
</section>

<footer class="bg-slate-900 text-gray-400 pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 mb-16">
        <div class="col-span-1 md:col-span-1">
            <div class="flex items-center space-x-3 text-white mb-6">
    <div class="w-25 h-25  flex items-center justify-center overflow-hidden">
        <img src="{{ asset('logo.png') }}" alt="Logo Gravity Studio" class="w-full h-full object-contain invert">
    </div>
    
    <div class="flex flex-col">
        <span class="text-xl font-bold leading-none text-gray-900">Gravity Studio</span>
    </div>
</div>
            <p class="text-sm leading-relaxed">Studio foto profesional dengan layanan premium dan hasil berkualitas tinggi untuk segala kebutuhan Anda.</p>
        </div>
        <div>
            <h5 class="text-white font-bold mb-6">Layanan</h5>
            <ul class="space-y-4 text-sm">
                <li><a href="#" class="hover:text-white transition">Prewedding</a></li>
                <li><a href="#" class="hover:text-white transition">Keluarga</a></li>
                <li><a href="#" class="hover:text-white transition">Produk</a></li>
                <li><a href="#" class="hover:text-white transition">Potret</a></li>
            </ul>
        </div>
        <div>
            <h5 class="text-white font-bold mb-6">Informasi</h5>
            <ul class="space-y-4 text-sm">
                <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-white transition">Galeri</a></li>
                <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                <li><a href="#" class="hover:text-white transition">FAQ</a></li>
            </ul>
        </div>
        <div>
            <h5 class="text-white font-bold mb-6">Kontak</h5>
            <ul class="space-y-4 text-sm">
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    +62 821-2222-3333
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    halo@gravitystudio.com
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Jl. Mekar Sari No.46, Tengkerang Selatan, Kec. Bukit Raya, Pekanbaru, Riau 28125
                </li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-800 flex flex-col md:row justify-between items-center text-xs">
        <p>&copy; 2025 Gravity Photography. Semua Hak Dilindungi.</p>
        <div class="flex gap-6 mt-4 md:mt-0">
            <a href="https://www.instagram.com/gravity_photo/" class="hover:text-white">Instagram</a>
        </div>
    </div>
</footer>

</body>
</html>