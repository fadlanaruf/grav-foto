<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket Foto - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">← Dashboard</a>
                    <h1 class="text-3xl font-bold text-gray-900 mt-1">Kelola Paket Foto</h1>
                </div>
                <a href="{{ route('admin.packages.create') }}" 
                   class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                    + Tambah Paket
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages as $package)
                    <div class="bg-white rounded-xl shadow-md p-6 {{ $package->is_active ? '' : 'opacity-60' }}">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $package->name }}</h3>
                            @if($package->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-semibold">Nonaktif</span>
                            @endif
                        </div>

                        <p class="text-gray-600 mb-4 text-sm">{{ $package->description }}</p>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Harga</span>
                                <span class="font-bold text-indigo-600">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Durasi</span>
                                <span class="font-semibold text-gray-900">{{ $package->duration_minutes }} menit</span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.packages.edit', $package) }}" 
                               class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-center font-semibold">
                                Edit
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
