<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Status Reservasi</h1>

                <div class="mb-8">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Reservasi</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $reservation->reservation_code }}</p>
                        </div>
                        <span class="px-4 py-2 bg-{{ $reservation->reservationStatus->color }}-100 text-{{ $reservation->reservationStatus->color }}-700 rounded-lg text-sm font-semibold">
                            {{ $reservation->reservationStatus->name }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $reservation->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Paket Foto</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $reservation->photoPackage->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Foto</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $reservation->photo_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status Pembayaran</p>
                        <p class="text-lg font-semibold {{ $reservation->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($reservation->payment_status) }}
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
