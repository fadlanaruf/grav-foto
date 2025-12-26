<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div class="min-h-screen py-12 px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-8 flex justify-between items-center">
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Riwayat
                </a>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">ID: #{{ $reservation->id }}</span>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-3xl animate-bounce">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[3rem] border border-gray-100 shadow-2xl shadow-indigo-500/5 overflow-hidden">
                @if($reservation->approved_at)
                    <div class="bg-emerald-500 px-8 py-4 flex items-center justify-center gap-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Pemesanan Dikonfirmasi Admin</p>
                    </div>
                @else
                    <div class="bg-amber-400 px-8 py-4 flex items-center justify-center gap-3">
                        <svg class="w-4 h-4 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Menunggu Verifikasi Pembayaran</p>
                    </div>
                @endif

                <div class="p-8 md:p-14">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6 mb-16 border-b border-gray-50 pb-10">
                        <div>
                            <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-2 block">Kode Reservasi</span>
                            <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-2">{{ $reservation->reservation_code }}</h1>
                            <p class="text-xs text-gray-400 font-medium italic">Dipesan pada {{ $reservation->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="text-left md:text-right">
                            <span class="inline-flex items-center pl-1 pr-4 py-2 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-2xl text-[11px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100 shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-3 animate-pulse"></span>
                                {{ $reservation->reservationStatus->name }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-10">
                            <div class="group">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center">
                                    <span class="w-5 h-px bg-gray-200 mr-2"></span> DATA PEMESAN
                                </p>
                                <h4 class="text-xl font-extrabold text-gray-900 leading-tight">{{ $reservation->name }}</h4>
                                <div class="mt-4 space-y-2">
                                    <p class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        {{ $reservation->phone }}
                                    </p>
                                    @if($reservation->address)
                                        <p class="flex items-start text-sm text-gray-500 leading-relaxed capitalize">
                                            <svg class="w-4 h-4 mr-2 mt-1 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $reservation->address }}
                                        </p>
                                    @else
                                        <p class="text-gray-400 text-xs italic bg-gray-50 p-3 rounded-2xl border border-dashed border-gray-200">Sesi foto dilakukan di studio (Gravity Studio Central).</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 flex items-center">
                                    <span class="w-5 h-px bg-gray-200 mr-2"></span> CATATAN KHUSUS
                                </p>
                                <div class="bg-indigo-50/30 border-l-4 border-indigo-500 p-4 rounded-r-2xl">
                                    <p class="text-gray-700 text-sm italic leading-relaxed">
                                        {{ $reservation->notes ?: 'Customer tidak menyertakan catatan tambahan.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 shadow-inner">
                                <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-6 border-b border-indigo-100 pb-2">Detail Paket & Waktu</p>
                                <div class="space-y-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-indigo-600 shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-900">{{ $reservation->photoPackage->name }}</p>
                                            <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">
                                                @php $cat = strtolower($reservation->photoPackage->category); @endphp
                                                @if($cat == 'wedding')
                                                    {{ $reservation->photoPackage->category }} - 
                                                    @switch($reservation->subcategory)
                                                        @case('prewedding') Pre-Wedding @break
                                                        @case('akad') Akad Nikah @break
                                                        @case('resepsi') Resepsi @break
                                                        @default {{ ucfirst($reservation->subcategory) }}
                                                    @endswitch
                                                @else
                                                    {{ $reservation->photoPackage->category }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-gray-400 shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Tanggal Sesi</p>
                                            <p class="text-sm font-black text-gray-900">{{ $reservation->photo_date->format('d F Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-gray-400 shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Waktu Pemotretan</p>
                                            <p class="text-sm font-black text-gray-900">{{ date('H:i', strtotime($reservation->photo_time)) }} WIB</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-gray-400 shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Jumlah Peserta</p>
                                            <p class="text-sm font-black text-gray-900">{{ $reservation->number_of_people }} Orang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 pt-12 border-t border-gray-100 flex flex-col md:flex-row justify-between items-end gap-10">
                        <div class="w-full">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Rincian Pembayaran</p>
                            <div class="space-y-4">
                                <div>
                                    <span class="text-sm text-gray-500 block mb-1 font-bold">Total yang harus dibayar:</span>
                                    <h2 class="text-5xl font-black text-indigo-600 tracking-tighter">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</h2>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-2xl">
                                        <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Metode</span>
                                        <p class="text-xs font-extrabold text-gray-700">
                                            @if($reservation->payment_method == 'bank_transfer') Transfer Bank BNI (No. Rek: 1134620469)
                                            @elseif($reservation->payment_method == 'cash') Tunai di Studio
                                            @else - @endif
                                        </p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-2xl">
                                        <span class="text-[9px] font-black text-gray-400 uppercase block mb-1">Tipe</span>
                                        <p class="text-xs font-extrabold text-gray-700">
                                            @if($reservation->payment_type == 'dp') DP 10%
                                            @elseif($reservation->payment_type == 'lunas') Lunas
                                            @else - @endif
                                        </p>
                                    </div>
                                </div>
                                @if($reservation->proof_of_payment)
                                    <a href="{{ asset('storage/' . $reservation->proof_of_payment) }}" target="_blank" class="inline-flex items-center text-[10px] font-black text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-xl transition-all border border-indigo-100 uppercase tracking-widest">
                                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Lihat Bukti Transfer
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="glass-card p-8 rounded-[2.5rem] border border-gray-100 shadow-xl min-w-60 flex flex-col items-center justify-center text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Status Pembayaran</p>
                            <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4 {{ $reservation->payment_status == 'paid' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-500' }}">
                                @if($reservation->payment_status == 'paid')
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @else
                                    <svg class="w-10 h-10 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                            </div>
                            <p class="text-xl font-black {{ $reservation->payment_status == 'paid' ? 'text-emerald-600' : 'text-amber-500' }} uppercase tracking-tighter">
                                {{ $reservation->payment_status == 'paid' ? 'LUNAS' : 'PENDING' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <p class="text-white text-sm font-bold">Ada kendala atau ingin menjadwalkan ulang?</p>
                        <p class="text-gray-400 text-xs">Hubungi Customer Service kami via WhatsApp untuk respon cepat.</p>
                    </div>
                    <a href="https://wa.me/6285265421321?text=Halo%20Admin%20Gravity%20Photography%2C%20saya%20ingin%20bertanya%20mengenai%20reservasi%20{{ $reservation->reservation_code }}" target="_blank" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-500/20 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.483 8.413-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.308 1.656zm6.757-4.791c1.512.898 3.222 1.373 4.975 1.374 5.439 0 9.865-4.427 9.868-9.867.001-2.635-1.025-5.111-2.89-6.978-1.863-1.866-4.339-2.891-6.973-2.892-5.441 0-9.866 4.426-9.869 9.866-.001 1.838.51 3.63 1.48 5.176l-1.004 3.67 3.753-.984zm9.839-11.02c-.3-.151-1.776-.876-2.051-.976-.275-.1-.475-.151-.675.151-.2.301-.776.977-.951 1.177-.175.2-.351.226-.651.076-.3-.151-1.267-.467-2.414-1.491-.893-.797-1.495-1.782-1.671-2.083-.175-.301-.018-.464.132-.613.135-.134.301-.351.451-.526.15-.175.201-.301.301-.501.1-.2.05-.376-.025-.526-.075-.151-.675-1.628-.926-2.229-.244-.585-.494-.507-.675-.516-.174-.009-.375-.01-.576-.01s-.526.076-.801.376c-.275.301-1.051 1.027-1.051 2.506s1.076 2.907 1.227 3.107c.15.2 2.117 3.232 5.128 4.532.716.31 1.275.495 1.71.635.72.229 1.375.196 1.893.119.578-.085 1.776-.726 2.026-1.427.25-.701.25-1.302.175-1.427-.075-.126-.275-.201-.576-.351z"/></svg>
                        Customer Care
                    </a>
                </div>
            </div>

            <div class="mt-12 text-center opacity-30">
                <p class="text-[10px] font-black uppercase tracking-[0.4em]">© Gravity Photography</p>
                <p class="text-[8px] mt-2 uppercase tracking-widest font-bold">Authorized Digital Receipt</p>
            </div>
        </div>
    </div>
</body>
</html>