<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi - Admin</title>
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
        @include('admin.partials.header')

        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Reservasi</h2>
                <p class="text-sm text-gray-400 mt-2 font-medium">Filter dan kelola seluruh pesanan pelanggan Anda.</p>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status Foto</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Pembayaran</label>
                        <select name="payment" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('payment') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ request('payment') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Approval</label>
                        <select name="approved" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua</option>
                            <option value="yes" {{ request('approved') == 'yes' ? 'selected' : '' }}>Sudah Disetujui</option>
                            <option value="no" {{ request('approved') == 'no' ? 'selected' : '' }}>Belum Disetujui</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Dari</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Sampai</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                    </div>
                    <div class="flex items-end gap-3">
                        <a href="{{ route('admin.reservations.index') }}" class="flex-1 py-3.5 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-all font-bold text-center text-sm">
                            Reset Filter
                        </a>
                        <button type="submit" class="flex-1 py-3.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all font-bold shadow-lg shadow-indigo-100 active:scale-95 text-sm">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            @php
                $activeFilters = [];
                if (request('status')) $activeFilters[] = 'Status: ' . $statuses->find(request('status'))?->name;
                if (request('payment')) $activeFilters[] = 'Pembayaran: ' . ucfirst(request('payment'));
                if (request('approved')) $activeFilters[] = 'Approval: ' . (request('approved') == 'yes' ? 'Sudah Disetujui' : 'Belum Disetujui');
                if (request('date_from')) $activeFilters[] = 'Dari: ' . date('d/m/Y', strtotime(request('date_from')));
                if (request('date_to')) $activeFilters[] = 'Sampai: ' . date('d/m/Y', strtotime(request('date_to')));
            @endphp

            @if($activeFilters)
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-4 mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span class="text-sm font-bold text-indigo-700">Filter Aktif:</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($activeFilters as $filter)
                            <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold">
                                {{ $filter }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                                <th class="py-5 px-8">Kode</th>
                                <th class="py-5 px-4">Customer</th>
                                <th class="py-5 px-4 text-center">Layanan</th>
                                <th class="py-5 px-4 text-center">Status</th>
                                <th class="py-5 px-4 text-center">Bayar</th>
                                <th class="py-5 px-4 text-center">Appr.</th>
                                <th class="py-5 px-8 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($reservations as $reservation)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="py-6 px-8">
                                    <span class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg">
                                        {{ $reservation->reservation_code }}
                                    </span>
                                </td>
                                <td class="py-6 px-4">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 leading-none">{{ $reservation->name }}</p>
                                        <p class="text-[11px] text-gray-400 mt-1.5 font-medium">{{ $reservation->photo_date->format('d M, Y') }}</p>
                                    </div>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    <div>
                                        <span class="text-sm font-bold text-gray-700">{{ $reservation->photoPackage->name }}</span>
                                        <div class="mt-1">
                                            <span class="inline-block px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-full text-[9px] font-extrabold uppercase tracking-wider border border-indigo-100">
                                                @switch($reservation->photoPackage->category)
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
                                                        {{ $reservation->photoPackage->category ?? 'General' }}
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center justify-center pl-1 pr-4 py-1.5 min-w-[120px] bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2"></span>
                                            {{ $reservation->reservationStatus->name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex justify-center">
                                        <span class="px-3 py-1.5 {{ $reservation->payment_status == 'paid' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }} border rounded-full text-[10px] font-black uppercase tracking-widest">
                                            {{ $reservation->payment_status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    @if($reservation->approved_at)
                                        <div class="flex justify-center">
                                            <div class="w-6 h-6 bg-emerald-500 text-white rounded-full flex items-center justify-center text-[10px] shadow-sm">
                                                ✓
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-lg">⏳</span>
                                    @endif
                                </td>
                                <td class="py-6 px-8 text-right">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center gap-2 text-sm font-black text-indigo-600 hover:text-indigo-800 group-hover:translate-x-1 transition-transform">
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data reservasi ini?');" class="inline-block ml-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 font-black text-sm transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="text-5xl mb-4 opacity-20">🗓️</div>
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Tidak ada data ditemukan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reservations->hasPages())
                <div class="p-6 bg-gray-50/30 border-t border-gray-50">
                    <div class="pagination-custom">
                        {{ $reservations->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>