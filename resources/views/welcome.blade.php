<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravity Photography - Reservasi</title>
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
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .gallery-item {
            height: 280px;
        }

        .gallery-item-tall {
            height: 450px;
        }

        @media (min-width: 768px) {
            .gallery-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            .gallery-item { height: 20rem; }
            .gallery-item-tall { grid-row: span 2; height: auto; }
        }
    </style>
</head>
<body class="bg-white text-gray-900">

@include('partials.header')

<section class="hero-background h-[600px] flex items-center pt-20">
    <div class="max-w-7xl mx-auto px-6 w-full text-center text-white">
        <h1 class="text-5xl md:text-5xl mb-4 tracking-tight" style="font-family: 'Rock Salt', cursive;">Come and Get Your Moments</h1>
        <p class="text-lg opacity-90 mb-12">Studio foto profesional dengan layanan premium dan hasil berkualitas tinggi.</p>
        
        <form action="{{ route('reservations.create') }}" method="GET" class="bg-white p-2 rounded-2xl shadow-2xl max-w-4xl mx-auto flex flex-col md:row text-gray-800">
            <div class="flex flex-col md:flex-row flex-1">
                <div class="flex-1 px-6 py-3 text-left border-r border-gray-100">
                    <label class="text-[10px] uppercase tracking-wider font-bold text-gray-400">Kategori</label>
                    <select name="category" class="w-full font-semibold bg-transparent focus:outline-none">
                        <option value="">Pilih Kategori</option>
                        <option value="corporate">Corporate</option>
                        <option value="ultah">Ulang Tahun</option>
                        <option value="dokumentasi">Dokumentasi</option>
                        <option value="lamaran">Lamaran</option>
                        <option value="martupol">Martupol</option>
                        <option value="personal">Personal</option>
                        <option value="keluarga">Keluarga</option>
                        <option value="maternity">Maternity</option>
                        <option value="wedding">Wedding</option>
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
            <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-xl hover:bg-indigo-700 font-bold transition">Reservasi Sekarang</button>
        </form>
    </div>
</section>

<section id="tracking" class="py-24 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full mb-6">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <h2 class="text-3xl font-extrabold mb-4">Lacak Status Reservasi</h2>
        <p class="text-gray-500 mb-8">Masukkan ID Reservasi untuk melihat status pemesanan, jadwal, dan progres foto.</p>
        <form action="{{ route('reservations.track') }}" method="POST" class="flex gap-2 p-2 bg-white rounded-2xl shadow-sm border border-gray-200">
            @csrf
            <input type="text" name="code" placeholder="Masukkan disini..." class="flex-1 px-4 focus:outline-none font-medium" required>
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
        <div class="gallery-item bg-gray-200 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover">
        </div>
        <div class="gallery-item bg-gray-200 rounded-3xl overflow-hidden shadow-lg">
            <img src="https://foto.co.id/wp-content/uploads/2013/09/IMG_7992.jpg" class="w-full h-full object-cover">
        </div>
        <div class="gallery-item bg-gray-200 rounded-3xl overflow-hidden shadow-lg">
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

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($packages as $package)
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold mb-2">{{ $package->name }}</h4>
                    <p class="text-sm text-gray-500 mb-4">{!! nl2br(e($package->description)) !!}</p>
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                            @switch($package->category)
                                @case('corporate')
                                    Corporate
                                    @break
                                @case('ultah')
                                    Ulang Tahun
                                    @break
                                @case('dokumentasi')
                                    Dokumentasi
                                    @break
                                @case('lamaran')
                                    Lamaran
                                    @break
                                @case('martupol')
                                    Martupol
                                    @break
                                @case('personal')
                                    Personal
                                    @break
                                @case('keluarga')
                                    Keluarga
                                    @break
                                @case('maternity')
                                    Maternity
                                    @break
                                @case('prewedding')
                                    Pre-Wedding
                                    @break
                                @default
                                    {{ $package->category ?? 'General' }}
                            @endswitch
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-600 font-extrabold text-lg">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">{{ $package->duration_minutes }} menit</p>
                        </div>
                        <div class="text-xs text-gray-400">
                            @if($package->location == 'indoor')
                                ● Indoor
                            @else
                                ● Outdoor
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('packages.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                Lihat Semua Paket
            </a>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-indigo-600 rounded-[40px] p-12 text-center text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-4xl font-extrabold mb-4">Siap Memulai Sesi Foto?</h2>
            <p class="opacity-80 mb-8 max-w-xl mx-auto">Reservasi sekarang dan dapatkan foto pertama anda.</p>
            <div class="flex justify-center gap-4">
                <button onclick="handleReservation()" class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold hover:bg-gray-100 transition">Reservasi Sekarang</button>
                <a href="https://wa.me/6285265421321" target="_blank" class="inline-block">
    <button class="bg-indigo-500 text-white px-8 py-4 rounded-2xl font-bold border border-white/20 hover:bg-indigo-400 transition">
        Hubungi Kami
    </button>
</a>
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
                    +62 852-6542-1321
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    gravityphotopku@gmail.com
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Jl. Mekar Sari No.46, Tengkerang Selatan, Kec. Bukit Raya, Pekanbaru, Riau 28125
                </li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-800 flex flex-col md:row justify-between items-center text-xs">
        <p>&copy; 2026 Gravity Photography. Semua Hak Dilindungi.</p>
        <div class="flex gap-6 mt-4 md:mt-0">
            <a href="https://www.instagram.com/gravity_photo/" class="hover:text-white">Instagram</a>
        </div>
    </div>
</footer>

</body>
</html>