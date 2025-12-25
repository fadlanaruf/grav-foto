<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div class="min-h-screen">
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

        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="group bg-white rounded-4xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest pt-1">Reservasi</span>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 leading-none">{{ $stats['total_reservations'] }}</h3>
                    <p class="text-xs text-gray-500 mt-2 font-medium">Total pemesanan masuk</p>
                </div>

                <div class="group bg-white rounded-4xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest pt-1">Pending</span>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 leading-none">{{ $stats['pending_reservations'] }}</h3>
                    <p class="text-xs text-gray-500 mt-2 font-medium italic">Menunggu persetujuan</p>
                </div>

                <div class="group bg-white rounded-4xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-purple-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V4" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest pt-1">Katalog</span>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 leading-none">{{ $stats['total_packages'] }}</h3>
                    <p class="text-xs text-gray-500 mt-2 font-medium">Paket foto tersedia</p>
                </div>

                <div class="group bg-white rounded-4xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.488 12.83a4 4 0 11-2.976 0" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest pt-1">Klien</span>
                    </div>
                    <h3 class="text-4xl font-black text-gray-900 leading-none">{{ $stats['total_klien'] }}</h3>
                    <p class="text-xs text-gray-500 mt-2 font-medium">Klien terdaftar</p>
                </div>
            </div>

            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Navigasi Utama</h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                    <a href="{{ route('admin.reservations.index') }}" class="group bg-white p-6 rounded-3xl border border-gray-100 hover:border-indigo-600 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-lg">
                        <div class="w-16 h-16 bg-indigo-50 text-3xl rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:scale-110 transition-all">📅</div>
                        <span class="font-bold text-gray-900">Reservasi</span>
                        <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Kelola Pesanan</span>
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="group bg-white p-6 rounded-3xl border border-gray-100 hover:border-purple-600 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-lg">
                        <div class="w-16 h-16 bg-purple-50 text-3xl rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:scale-110 transition-all">📦</div>
                        <span class="font-bold text-gray-900">Paket Foto</span>
                        <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Update Layanan</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="group bg-white p-6 rounded-3xl border border-gray-100 hover:border-green-600 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-lg">
                        <div class="w-16 h-16 bg-green-50 text-3xl rounded-2xl flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:scale-110 transition-all">👥</div>
                        <span class="font-bold text-gray-900">Klien</span>
                        <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Kelola Akun</span>
                    </a>
                    <a href="{{ route('admin.statuses.index') }}" class="group bg-white p-6 rounded-3xl border border-gray-100 hover:border-blue-600 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-lg">
                        <div class="w-16 h-16 bg-blue-50 text-3xl rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:scale-110 transition-all">🏷️</div>
                        <span class="font-bold text-gray-900">Status</span>
                        <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Workflow</span>
                    </a>
                    <a href="{{ route('admin.albums.index') }}" class="group bg-white p-6 rounded-3xl border border-gray-100 hover:border-pink-600 transition-all duration-300 flex flex-col items-center text-center shadow-sm hover:shadow-lg">
                        <div class="w-16 h-16 bg-pink-50 text-3xl rounded-2xl flex items-center justify-center mb-4 group-hover:bg-pink-600 group-hover:scale-110 transition-all">🖼️</div>
                        <span class="font-bold text-gray-900">Album</span>
                        <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Portofolio Galeri</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight leading-none">Reservasi Terbaru</h2>
                        <p class="text-sm text-gray-400 mt-2 font-medium">Update pemesanan yang baru saja masuk ke sistem.</p>
                    </div>
                    <button class="px-6 py-3 bg-indigo-600 text-white rounded-2xl text-sm font-bold flex items-center gap-2 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Reservasi
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                         <th class="py-5 px-8">ID</th>
                        <th class="py-5 px-4">Customer</th>
                        <th class="py-5 px-4">Layanan</th>
                         <th class="py-5 px-4">Jadwal Foto</th>
                        <th class="py-5 px-4 text-center align-middle">Status</th> 
                        <th class="py-5 px-8 text-right">Navigasi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentReservations as $reservation)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="py-6 px-8">
                                    <span class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg">
                                        {{ $reservation->reservation_code }}
                                    </span>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-xs font-black text-gray-500 uppercase tracking-tighter">
                                            {{ substr($reservation->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 leading-none">{{ $reservation->name }}</p>
                                            <p class="text-[11px] text-gray-400 mt-1.5 font-medium">{{ $reservation->email ?? 'No email provided' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 px-4">
                                    <span class="text-sm font-bold text-gray-700">{{ $reservation->photoPackage->name }}</span>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex items-center gap-2 text-sm font-bold text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $reservation->photo_date->format('d M, Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center">
                             <div class="flex justify-center items-center w-full">
                              <span class="inline-flex items-center justify-center pl-1 pr-4 py-1.5 min-w-10 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100">
                              <span class="w-1.5 h-1.5 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2 shrink-0"></span>
                             {{ $reservation->reservationStatus->name }}
                            </span>
                             </div>
                                </td>
                                <td class="py-6 px-8 text-right">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center gap-2 text-sm font-black text-indigo-600 hover:text-indigo-800 group-hover:translate-x-1 transition-transform">
                                        Buka
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-20 text-center">
                                    <div class="text-5xl mb-4 opacity-30 italic">No Data</div>
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada reservasi masuk</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gray-50/30 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                        Showing <span class="text-indigo-600">{{ count($recentReservations) }}</span> of {{ $stats['total_reservations'] }} Records
                    </p>
                    <a href="{{ route('admin.reservations.index') }}" class="px-6 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:bg-gray-50 transition-all shadow-sm">
                        Lihat Semua Log Reservasi →
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>