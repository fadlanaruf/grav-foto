<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gravity Studio</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <p class="text-sm text-gray-500 mb-1">Total Reservasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reservations'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <p class="text-sm text-gray-500 mb-1">Menunggu Approval</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_reservations'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <p class="text-sm text-gray-500 mb-1">Paket Foto</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_packages'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <p class="text-sm text-gray-500 mb-1">Total User</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_users'] }}</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Menu Utama</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.reservations.index') }}" 
                       class="p-4 border-2 border-indigo-200 rounded-lg hover:bg-indigo-50 transition text-center">
                        <div class="text-3xl mb-2">📅</div>
                        <p class="font-semibold text-gray-900">Reservasi</p>
                    </a>
                    <a href="{{ route('admin.packages.index') }}" 
                       class="p-4 border-2 border-indigo-200 rounded-lg hover:bg-indigo-50 transition text-center">
                        <div class="text-3xl mb-2">📦</div>
                        <p class="font-semibold text-gray-900">Paket Foto</p>
                    </a>
                    <a href="{{ route('admin.statuses.index') }}" 
                       class="p-4 border-2 border-indigo-200 rounded-lg hover:bg-indigo-50 transition text-center">
                        <div class="text-3xl mb-2">🏷️</div>
                        <p class="font-semibold text-gray-900">Status</p>
                    </a>
                    <a href="{{ route('admin.albums.index') }}" 
                       class="p-4 border-2 border-indigo-200 rounded-lg hover:bg-indigo-50 transition text-center">
                        <div class="text-3xl mb-2">🖼️</div>
                        <p class="font-semibold text-gray-900">Album</p>
                    </a>
                </div>
            </div>

            <!-- Recent Reservations -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Reservasi Terbaru</h2>
                @if($recentReservations->isEmpty())
                    <p class="text-gray-500 text-center py-8">Belum ada reservasi</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Kode</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Paket</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReservations as $reservation)
                                    <tr class="border-b hover:bg-gray-50">
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
                                            <a href="{{ route('admin.reservations.show', $reservation) }}" 
                                               class="text-indigo-600 hover:text-indigo-700 font-semibold">
                                                Detail →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
