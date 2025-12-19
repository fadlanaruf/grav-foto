<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">← Dashboard</a>
                    <h1 class="text-2xl font-bold text-gray-900 mt-1">Kelola Reservasi</h1>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pembayaran</label>
                        <select name="payment" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('payment') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ request('payment') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Approval</label>
                        <select name="approved" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Semua</option>
                            <option value="yes" {{ request('approved') == 'yes' ? 'selected' : '' }}>Sudah Disetujui</option>
                            <option value="no" {{ request('approved') == 'no' ? 'selected' : '' }}>Belum Disetujui</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Reservations Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Kode</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Paket</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Pembayaran</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Approval</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="py-3 px-4 font-mono text-sm">{{ $reservation->reservation_code }}</td>
                                    <td class="py-3 px-4">{{ $reservation->name }}</td>
                                    <td class="py-3 px-4">{{ $reservation->photoPackage->name }}</td>
                                    <td class="py-3 px-4">{{ $reservation->photo_date->format('d M Y') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 bg-{{ $reservation->reservationStatus->color }}-100 text-{{ $reservation->reservationStatus->color }}-700 rounded text-xs font-semibold">
                                            {{ $reservation->reservationStatus->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 {{ $reservation->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded text-xs font-semibold">
                                            {{ ucfirst($reservation->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($reservation->approved_at)
                                            <span class="text-green-600">✓</span>
                                        @else
                                            <span class="text-yellow-600">⏳</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('admin.reservations.show', $reservation) }}" 
                                           class="text-indigo-600 hover:text-indigo-700 font-semibold">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-gray-500">
                                        Tidak ada reservasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reservations->hasPages())
                    <div class="px-6 py-4 border-t">
                        {{ $reservations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
