<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi</title>
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
    <div class="min-h-screen py-12 px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-8">
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Riwayat
                </a>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                @if($reservation->approved_at)
                    <div class="bg-emerald-500 px-8 py-3 text-center">
                        <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Pemesanan ini telah dikonfirmasi oleh Admin</p>
                    </div>
                @else
                    <div class="bg-amber-400 px-8 py-3 text-center">
                        <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Menunggu verifikasi pembayaran oleh Admin</p>
                    </div>
                @endif

                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6 mb-12">
                        <div>
                            <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-2 block">Invoice Code</span>
                            <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $reservation->reservation_code }}</h1>
                        </div>
                        <div class="flex flex-col md:items-end gap-2">
                            <span class="inline-flex items-center pl-1 pr-4 py-1.5 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2"></span>
                                {{ $reservation->reservationStatus->name }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-8">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Data Pemesan</p>
                                <h4 class="text-lg font-bold text-gray-900 leading-tight">{{ $reservation->name }}</h4>
                                <p class="text-gray-500 text-sm mt-1 leading-relaxed">{{ $reservation->address }}</p>
                                <p class="text-gray-900 text-sm font-bold mt-2">{{ $reservation->phone }}</p>
                            </div>
                            
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Catatan Pesanan</p>
                                <p class="text-gray-600 text-sm italic leading-relaxed">
                                    {{ $reservation->notes ?: 'Tidak ada catatan tambahan.' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Detail Sesi Foto</p>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ $reservation->photoPackage->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ $reservation->photo_date->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ date('H:i', strtotime($reservation->photo_time)) }} WIB</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white rounded-xl flex items-center justify-center shadow-sm text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ $reservation->number_of_people }} Orang</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-8">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Biaya</p>
                            <h2 class="text-3xl font-black text-indigo-600">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</h2>
                            <p class="text-sm text-gray-500 mt-2">Metode Pembayaran: 
                                @if($reservation->payment_method == 'bank_transfer') Transfer Bank
                                @elseif($reservation->payment_method == 'e_wallet') E-Wallet
                                @elseif($reservation->payment_method == 'cash') Tunai (Bayar di Studio)
                                @else - @endif
                            </p>
                            <p class="text-sm text-gray-500 mt-1">Tipe Pembayaran: 
                                @if($reservation->payment_type == 'dp') DP (Down Payment)
                                @elseif($reservation->payment_type == 'lunas') Lunas
                                @else - @endif
                            </p>
                            @if($reservation->proof_of_payment)
                                <p class="text-sm text-gray-500 mt-1">Bukti Pembayaran: <a href="{{ asset('storage/' . $reservation->proof_of_payment) }}" target="_blank" class="text-indigo-600 underline">Lihat Bukti</a></p>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 bg-gray-50 px-6 py-4 rounded-3xl border border-gray-100 w-full md:w-auto">
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Status Bayar</p>
                                <p class="text-sm font-black {{ $reservation->payment_status == 'paid' ? 'text-emerald-600' : 'text-amber-500' }} uppercase">
                                    {{ $reservation->payment_status }}
                                </p>
                            </div>
                            <div class="w-px h-8 bg-gray-200 mx-2"></div>
                            @if($reservation->approved_at)
                                <div class="text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @else
                                <div class="text-amber-400 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex justify-center">
                    <p class="text-xs text-gray-400 font-medium">Butuh bantuan? Hubungi WhatsApp Admin dengan tekan URL ini</p>
                </div>
            </div>

            <div class="mt-12 text-center opacity-30">
                <p class="text-[10px] font-black uppercase tracking-[0.4em]">Gravity Studio © 2025</p>
            </div>
        </div>
    </div>
</body>
</html>