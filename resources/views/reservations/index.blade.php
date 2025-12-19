<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Riwayat Reservasi</h1>
                    <p class="text-gray-600 mt-1">Lihat semua reservasi Anda</p>
                </div>
                <a href="{{ route('reservations.create') }}" 
                   class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                    + Buat Reservasi Baru
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($reservations->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <p class="text-gray-500 text-lg">Anda belum memiliki reservasi.</p>
                    <a href="{{ route('reservations.create') }}" 
                       class="inline-block mt-4 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Buat Reservasi Pertama
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($reservations as $reservation)
                        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $reservation->reservation_code }}</h3>
                                        <span class="px-3 py-1 bg-{{ $reservation->reservationStatus->color }}-100 text-{{ $reservation->reservationStatus->color }}-700 rounded-full text-sm font-semibold">
                                            {{ $reservation->reservationStatus->name }}
                                        </span>
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                            {{ ucfirst($reservation->payment_status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Paket Foto</p>
                                            <p class="font-semibold text-gray-900">{{ $reservation->photoPackage->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Nama</p>
                                            <p class="font-semibold text-gray-900">{{ $reservation->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Tanggal Foto</p>
                                            <p class="font-semibold text-gray-900">{{ $reservation->photo_date->format('d M Y') }} - {{ date('H:i', strtotime($reservation->photo_time)) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Jumlah Orang</p>
                                            <p class="font-semibold text-gray-900">{{ $reservation->number_of_people }} orang</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('reservations.show', $reservation) }}" 
                                   class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                                    Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
