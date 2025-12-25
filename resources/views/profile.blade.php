<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Gravity Studio</title>
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
    <div class="min-h-screen py-12 px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Beranda
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

            @if($errors->any())
                <div class="flex items-start p-4 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                    <svg class="w-5 h-5 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm font-bold">
                        <p class="mb-1">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="list-disc list-inside font-medium opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-12">
                
                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-4xl font-black tracking-tight text-gray-900">Profil <span class="text-indigo-600">Saya</span></h1>
                    <p class="text-gray-500 mt-2 font-medium">Kelola informasi akun Anda di sini.</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label for="name" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required placeholder="Contoh: John Doe"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required placeholder="john@example.com"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="phone" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="0812..."
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Password (Opsional)</h3>
                        
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="current_password" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Saat Ini</label>
                                <input type="password" name="current_password" id="current_password" placeholder="Masukkan password saat ini"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                            </div>

                            <div class="space-y-2">
                                <label for="new_password" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Minimal 8 karakter"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                            </div>

                            <div class="space-y-2">
                                <label for="new_password_confirmation" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Ulangi password baru"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 pt-6">
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 px-8 py-4 border border-gray-100 text-gray-400 rounded-2xl hover:bg-gray-50 hover:text-gray-600 transition-all text-center font-bold text-sm active:scale-95">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-2 px-8 py-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-black text-sm shadow-xl shadow-indigo-100 active:scale-95 uppercase tracking-widest">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-12 text-center opacity-30">
                <p class="text-[10px] font-black uppercase tracking-[0.4em]">Gravity Studio © 2025</p>
            </div>
        </div>
    </div>
</body>
</html>