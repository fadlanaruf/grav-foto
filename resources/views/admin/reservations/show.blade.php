<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.reservations.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">← Kembali ke Daftar Reservasi</a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $reservation->reservation_code }}</h1>
                                <p class="text-gray-600 mt-1">Dibuat: {{ $reservation->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <span class="px-4 py-2 bg-{{ $reservation->reservationStatus->color }}-100 text-{{ $reservation->reservationStatus->color }}-700 rounded-lg font-semibold">
                                {{ $reservation->reservationStatus->name }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">User</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->address }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Paket Foto</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->photoPackage->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah Orang</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->number_of_people }} orang</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Foto</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $reservation->photo_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Waktu</p>
                                <p class="text-lg font-semibold text-gray-900">{{ date('H:i', strtotime($reservation->photo_time)) }}</p>
                            </div>
                        </div>

                        @if($reservation->notes)
                            <div class="mt-6 pt-6 border-t">
                                <p class="text-sm text-gray-500 mb-2">Catatan Customer</p>
                                <p class="text-gray-900">{{ $reservation->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Admin Notes -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Catatan Admin</h3>
                        <form action="{{ route('admin.reservations.updateNotes', $reservation) }}" method="POST">
                            @csrf
                            <textarea name="admin_notes" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">{{ $reservation->admin_notes }}</textarea>
                            <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Simpan Catatan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="space-y-6">
                    <!-- Approval -->
                    @if(!$reservation->approved_at)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Approval</h3>
                            <form action="{{ route('admin.reservations.approve', $reservation) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                                    ✓ Setujui Reservasi
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <p class="text-green-700 font-semibold">✓ Sudah Disetujui</p>
                            <p class="text-sm text-green-600 mt-1">{{ $reservation->approved_at->format('d M Y H:i') }}</p>
                            @if($reservation->approver)
                                <p class="text-sm text-green-600">oleh {{ $reservation->approver->name }}</p>
                            @endif
                        </div>
                    @endif

                    <!-- Update Status -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Update Status</h3>
                        <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST">
                            @csrf
                            <select name="reservation_status_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $reservation->reservation_status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Payment -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Pembayaran</h3>
                        <p class="text-2xl font-bold text-indigo-600 mb-4">Rp {{ number_format($reservation->payment_amount, 0, ',', '.') }}</p>
                        <form action="{{ route('admin.reservations.updatePayment', $reservation) }}" method="POST">
                            @csrf
                            <select name="payment_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3">
                                <option value="pending" {{ $reservation->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $reservation->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="cancelled" {{ $reservation->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Update Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
