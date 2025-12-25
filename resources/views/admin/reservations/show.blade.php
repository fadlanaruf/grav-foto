<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Admin</title>
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
    <div class="min-h-screen py-10 px-4 md:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Reservasi
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-10">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                            <div>
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 block text-center md:text-left">Booking ID</span>
                                <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $reservation->reservation_code }}</h1>
                                <p class="text-gray-400 text-xs mt-2 font-medium">Dibuat pada: {{ $reservation->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="flex justify-center w-full md:w-auto">
                                <span class="inline-flex items-center pl-1 pr-4 py-2.5 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-2xl text-xs font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2.5 animate-pulse"></span>
                                    {{ $reservation->reservationStatus->name }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 border-t border-gray-50 pt-10">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Pelanggan</p>
                                <p class="text-base font-bold text-gray-900">{{ $reservation->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Akun Klien</p>
                                <p class="text-base font-bold text-gray-900">{{ $reservation->user->name }}</p>
                            </div>
                            <div class="space-y-1 md:col-span-2">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat Lokasi</p>
                                <p class="text-base font-bold text-gray-900 leading-relaxed">{{ $reservation->address }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nomor Telepon</p>
                                <p class="text-base font-bold text-gray-900">{{ $reservation->phone }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Paket Pilihan</p>
                                <p class="text-base font-bold text-indigo-600">{{ $reservation->photoPackage->name }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jadwal Foto</p>
                                <div class="flex items-center gap-2 text-base font-bold text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $reservation->photo_date->format('d M Y') }} — {{ date('H:i', strtotime($reservation->photo_time)) }} WIB
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Peserta</p>
                                <p class="text-base font-bold text-gray-900">{{ $reservation->number_of_people }} Orang</p>
                            </div>
                        </div>

                        @if($reservation->notes)
                            <div class="mt-10 pt-8 border-t border-gray-50">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Catatan Khusus Pelanggan</p>
                                <div class="bg-gray-50 p-5 rounded-2xl italic text-gray-600 text-sm leading-relaxed">
                                    "{{ $reservation->notes }}"
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                            <h3 class="text-xl font-black text-gray-900 tracking-tight">Internal Memo</h3>
                        </div>
                        <form action="{{ route('admin.reservations.updateNotes', $reservation) }}" method="POST">
                            @csrf
                            <textarea name="admin_notes" rows="4" 
                                      placeholder="Tulis catatan internal di sini..."
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-medium text-sm text-gray-700 mb-4">{{ $reservation->admin_notes }}</textarea>
                            <button type="submit" class="px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-sm shadow-lg shadow-gray-200 active:scale-95">
                                Perbarui Memo
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-8">
                    @if(!$reservation->approved_at)
                        <div class="bg-indigo-600 rounded-4xl p-8 shadow-xl shadow-indigo-100 relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                            <h3 class="text-lg font-black text-white mb-2 relative z-10">Persetujuan</h3>
                            <p class="text-indigo-100 text-xs mb-6 font-medium relative z-10">Tinjau data reservasi sebelum memberikan persetujuan.</p>
                            <form action="{{ route('admin.reservations.approve', $reservation) }}" method="POST" class="relative z-10">
                                @csrf
                                <button type="submit" class="w-full px-4 py-4 bg-white text-indigo-600 rounded-2xl hover:bg-indigo-50 transition-all font-black text-sm shadow-lg active:scale-95 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve Sekarang
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-emerald-50 border border-emerald-100 rounded-4xl p-8">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-emerald-700 font-black text-sm uppercase tracking-wider">Telah Disetujui</p>
                                    <p class="text-[10px] text-emerald-600 font-bold opacity-75 uppercase tracking-tighter">Approved Status</p>
                                </div>
                            </div>
                            <div class="space-y-2 pt-4 border-t border-emerald-100/50">
                                <p class="text-xs text-emerald-700 font-medium tracking-tight">
                                    <span class="opacity-60">Waktu:</span> {{ $reservation->approved_at->format('d M Y, H:i') }}
                                </p>
                                @if($reservation->approver)
                                    <p class="text-xs text-emerald-700 font-medium tracking-tight">
                                        <span class="opacity-60">Oleh:</span> Admin {{ $reservation->approver->name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8">
                        <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Update Alur Kerja</h3>
                        <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST">
                            @csrf
                            <select name="reservation_status_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 mb-4">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $reservation->reservation_status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-xs uppercase tracking-widest active:scale-95 shadow-md">
                                Simpan Status
                            </button>
                        </form>
                    </div>

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8 overflow-hidden relative">
                        <div class="absolute -right-2.5 -top-2.5 text-indigo-50 opacity-50 rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 relative z-10">Total Tagihan</h3>
                        <p class="text-3xl font-black text-indigo-600 mb-4 relative z-10">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</p>
                        
                        @if($reservation->proof_of_payment)
                            <div class="mb-6 relative z-10">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Bukti Pembayaran</p>
                                <a href="{{ asset('storage/' . $reservation->proof_of_payment) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl hover:bg-emerald-100 transition-all font-bold text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Bukti Pembayaran
                                </a>
                            </div>
                        @else
                            <div class="mb-6 relative z-10">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Bukti Pembayaran</p>
                                <p class="text-sm text-amber-600 font-medium">Belum ada bukti pembayaran diupload.</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.reservations.updatePayment', $reservation) }}" method="POST" class="relative z-10">
                            @csrf
                            <div class="space-y-4">
                                <select name="payment_status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                    <option value="pending" {{ $reservation->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $reservation->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="cancelled" {{ $reservation->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all font-bold text-xs uppercase tracking-widest active:scale-95 shadow-lg shadow-indigo-100">
                                    Update Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>