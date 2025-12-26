<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Admin Panel</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        .section-label {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #94A3B8;
            margin-bottom: 0.5rem;
            display: block;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div class="min-h-screen">
        @include('admin.partials.header')

        <div class="max-w-6xl mx-auto py-10 px-4 md:px-8">
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
                    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-10 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 opacity-50"></div>

                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 relative z-10">
                            <div>
                                <span class="section-label text-indigo-500">Struk</span>
                                <h1 class="text-3xl font-black text-gray-900 tracking-tight">{{ $reservation->reservation_code }}</h1>
                                <p class="text-gray-400 text-xs mt-1 font-medium italic">Waktu Pesan: {{ $reservation->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center pl-1 pr-4 py-2 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-2xl text-xs font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2.5 animate-pulse"></span>
                                    {{ $reservation->reservationStatus->name }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-12 border-t border-gray-50 pt-10 relative z-10">
                            <div>
                                <span class="section-label">Pelanggan</span>
                                <p class="text-lg font-extrabold text-gray-900 leading-tight">{{ $reservation->name }}</p>
                                <p class="text-sm font-bold text-gray-400 mt-1">{{ $reservation->phone }}</p>
                                <div class="mt-2 text-xs font-medium text-indigo-500 px-2 py-1 bg-indigo-50 inline-block rounded-lg border border-indigo-100">
                                    User ID: {{ $reservation->user->name }}
                                </div>
                            </div>

                            <div>
                                <span class="section-label">Jadwal Sesi</span>
                                <div class="flex items-center gap-2 text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-base font-extrabold">{{ $reservation->photo_date->locale('id')->translatedFormat('l, d M Y') }}</p>
                                </div>
                                <p class="text-sm font-bold text-gray-500 mt-1 pl-7">{{ date('H:i', strtotime($reservation->photo_time)) }} WIB ({{ $reservation->number_of_people }} Orang)</p>
                            </div>

                            <div class="md:col-span-2">
                                <span class="section-label">Lokasi Pemotretan</span>
                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    @if($reservation->address)
                                        <p class="text-base font-bold text-gray-800">{{ $reservation->address }}</p>
                                    @else
                                        <p class="text-base font-bold text-emerald-600">Studio Gravity Central (Indoor)</p>
                                    @endif
                                </div>
                            </div>

                            <div class="md:col-span-2 bg-gray-50 p-6 rounded-3xl border border-gray-100">
                                <span class="section-label text-indigo-400">Paket & Layanan</span>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-xl font-black text-gray-900">{{ $reservation->photoPackage->name }}</h3>
                                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mt-1">
                                            @php $cat = strtolower($reservation->photoPackage->category); @endphp
                                            @if($cat == 'wedding')
                                                Wedding Service — 
                                                @switch($reservation->subcategory)
                                                    @case('prewedding') Pre-Wedding @break
                                                    @case('akad') Akad Nikah @break
                                                    @case('resepsi') Resepsi @break
                                                    @default {{ ucfirst($reservation->subcategory) }}
                                                @endswitch
                                            @else
                                                {{ $reservation->photoPackage->category }} Service
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-black text-indigo-600">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($reservation->notes)
                            <div class="mt-8 pt-8 border-t border-gray-50">
                                <span class="section-label">Catatan Pelanggan</span>
                                <div class="bg-amber-50/50 border-l-4 border-amber-400 p-5 rounded-r-2xl italic text-gray-700 text-sm leading-relaxed">
                                    "{{ $reservation->notes }}"
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                            <h3 class="text-xl font-black text-gray-900 tracking-tight">Internal Memo Admin</h3>
                        </div>
                        <form action="{{ route('admin.reservations.updateNotes', $reservation) }}" method="POST">
                            @csrf
                            <textarea name="admin_notes" rows="4" 
                                      placeholder="Tulis instruksi fotografer atau catatan khusus di sini..."
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-medium text-sm text-gray-700 mb-4">{{ $reservation->admin_notes }}</textarea>
                            <button type="submit" class="px-8 py-3 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-xs uppercase tracking-widest shadow-lg shadow-gray-200 active:scale-95">
                                Update Memo Internal
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-indigo-600 rounded-4xl p-8 shadow-xl shadow-indigo-100 relative overflow-hidden group">
                        @if(!$reservation->approved_at)
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                            <h3 class="text-lg font-black text-white mb-2 relative z-10">Approval</h3>
                            <p class="text-indigo-100 text-xs mb-6 font-medium relative z-10 leading-relaxed">Persetujuan admin menandakan data pemesanan sudah benar dan jadwal tersedia.</p>
                            <form action="{{ route('admin.reservations.approve', $reservation) }}" method="POST" class="relative z-10">
                                @csrf
                                <button type="submit" class="w-full px-4 py-4 bg-white text-indigo-600 rounded-2xl hover:bg-indigo-50 transition-all font-black text-sm shadow-lg active:scale-95 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    Konfirmasi Reservasi
                                </button>
                            </form>
                        @else
                            <div class="bg-white/10 border border-white/20 rounded-3xl p-6 text-white">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-emerald-400 text-white rounded-full flex items-center justify-center shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <div>
                                        <p class="font-black text-sm uppercase">Approved</p>
                                        <p class="text-[10px] opacity-70 uppercase font-bold tracking-tighter">By {{ $reservation->approver->name ?? 'System' }}</p>
                                    </div>
                                </div>
                                <p class="text-[10px] font-medium opacity-80 italic">Waktu: {{ $reservation->approved_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8">
                        <span class="section-label">Finance Control</span>
                        <h3 class="text-xl font-black text-gray-900 mb-6">Payment Status</h3>
                        
                        <div class="space-y-4 mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Metode Pembayaran</p>
                                <p class="text-sm font-bold text-gray-900">
                                    @if($reservation->payment_method == 'bank_transfer') Transfer Bank BNI (1134620469)
                                    @elseif($reservation->payment_method == 'cash') Tunai
                                    @else {{ $reservation->payment_method }} @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tipe Pembayaran</p>
                                <p class="text-sm font-bold text-gray-900 uppercase">{{ $reservation->payment_type == 'dp' ? 'DP (Down Payment)' : 'Lunas' }}</p>
                            </div>
                        </div>

                        @if($reservation->proof_of_payment)
                            <div class="mb-6">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Bukti Transfer Client</p>
                                <a href="{{ asset('storage/' . $reservation->proof_of_payment) }}" target="_blank" class="flex items-center gap-3 p-3 bg-emerald-50 text-emerald-700 rounded-2xl hover:bg-emerald-100 transition-all group border border-emerald-100">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                    <span class="text-xs font-black uppercase tracking-tight">Buka Bukti Bayar</span>
                                </a>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-amber-50 border border-amber-100 rounded-2xl">
                                <p class="text-[10px] text-amber-700 font-bold uppercase tracking-tight">Belum Ada Bukti</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.reservations.updatePayment', $reservation) }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <select name="payment_status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                    <option value="pending" {{ $reservation->payment_status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                                    <option value="paid" {{ $reservation->payment_status == 'paid' ? 'selected' : '' }}>✅ Paid</option>
                                    <option value="cancelled" {{ $reservation->payment_status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                </select>
                                <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all font-bold text-xs uppercase tracking-widest active:scale-95">
                                    Simpan Status Bayar
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8">
                        <span class="section-label">Workflow Status</span>
                        <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <select name="reservation_status_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $reservation->reservation_status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-xs uppercase tracking-widest active:scale-95 shadow-md">
                                    Update Alur Kerja
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