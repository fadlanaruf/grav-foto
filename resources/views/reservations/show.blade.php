<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Reservasi</h1>
                        <p class="text-gray-600 mt-1">{{ $reservation->reservation_code }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-4 py-2 bg-{{ $reservation->reservationStatus->color }}-100 text-{{ $reservation->reservationStatus->color }}-700 rounded-lg text-sm font-semibold">
                            {{ $reservation->reservationStatus->name }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->address }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nomor Telepon</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->phone }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Paket Foto</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->photoPackage->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Orang</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->number_of_people }} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal & Waktu Foto</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $reservation->photo_date->format('d M Y') }} - {{ date('H:i', strtotime($reservation->photo_time)) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-indigo-600">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Pembayaran</p>
                            <p class="text-lg font-semibold {{ $reservation->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($reservation->payment_status) }}
                            </p>
                        </div>
                    </div>
                </div>

                @if($reservation->notes)
                    <div class="border-t pt-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Catatan</h3>
                        <p class="text-gray-700">{{ $reservation->notes }}</p>
                    </div>
                @endif

                @if($reservation->approved_at)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-green-700 font-semibold">✓ Reservasi telah disetujui</p>
                        <p class="text-sm text-green-600 mt-1">Disetujui pada {{ $reservation->approved_at->format('d M Y H:i') }}</p>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-yellow-700 font-semibold">⏳ Menunggu persetujuan admin</p>
                    </div>
                @endif

                <div class="flex gap-4">
                    <a href="{{ route('reservations.index') }}" 
                       class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-center font-semibold">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
