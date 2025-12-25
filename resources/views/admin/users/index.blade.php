<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Klien - Admin</title>
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
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Kelola <span class="text-indigo-600">Klien</span></h1>
                    <p class="text-gray-500 mt-2 font-medium">Daftar semua klien terdaftar di sistem.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" 
                   class="px-6 py-3 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-bold text-sm shadow-lg shadow-indigo-200 active:scale-95">
                    Tambah Klien Baru
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

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama</th>
                                    <th class="text-left py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</th>
                                    <th class="text-left py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Phone</th>
                                    <th class="text-left py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Role</th>
                                    <th class="text-left py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Dibuat</th>
                                    <th class="text-right py-4 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                        <td class="py-6 px-4">
                                            <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                        </td>
                                        <td class="py-6 px-4">
                                            <div class="text-gray-600">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-6 px-4">
                                            <div class="text-gray-600">{{ $user->phone ?: '-' }}</div>
                                        </td>
                                        <td class="py-6 px-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest 
                                                {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="py-6 px-4">
                                            <div class="text-gray-600 text-sm">{{ $user->created_at->format('d M Y') }}</div>
                                        </td>
                                        <td class="py-6 px-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-bold text-xs uppercase tracking-widest">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" 
                                                      onsubmit="return confirm('Yakin hapus klien ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="px-4 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition font-bold text-xs uppercase tracking-widest">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 px-4 text-center text-gray-500">
                                            Belum ada klien terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                        <div class="mt-8 px-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>