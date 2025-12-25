<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi - Gravity Studio</title>
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
            
            <div class="mb-10 text-center md:text-left">
             
                <h1 class="text-4xl font-black tracking-tight text-gray-900">Buat <span class="text-indigo-600">Reservasi</span></h1>
                <p class="text-gray-500 mt-2 font-medium">Lengkapi detail di bawah untuk menjadwalkan sesi foto Anda.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-12">
                
                @if ($errors->any())
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

                <form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label for="photo_package_id" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Pilih Paket Layanan</label>
                        <div class="relative">
                            <select name="photo_package_id" id="photo_package_id" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                <option value="">— Cari Paket Foto —</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ request('photo_package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="name" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: John Doe"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="address" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                        <textarea name="address" id="address" rows="3" required placeholder="Masukkan alamat lengkap Anda..."
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="phone" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="0812..."
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                        </div>
                        <div class="space-y-2">
                            <label for="number_of_people" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jumlah Peserta</label>
                            <div class="relative">
                                <input type="number" name="number_of_people" id="number_of_people" value="{{ old('number_of_people', 1) }}" min="1" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400">ORANG</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="photo_date" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Sesi</label>
                            <input type="date" name="photo_date" id="photo_date" value="{{ old('photo_date', request('photo_date')) }}" required
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                        </div>
                        <div class="space-y-2">
                            <label for="photo_time" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jam Sesi</label>
                            <input type="time" name="photo_time" id="photo_time" value="{{ old('photo_time', request('photo_time')) }}" required
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="payment_method" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                            <option value="">— Pilih Metode Pembayaran —</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai (Bayar di Studio)</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="payment_type" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe Pembayaran</label>
                        <select name="payment_type" id="payment_type" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                            <option value="">— Pilih Tipe Pembayaran —</option>
                            <option value="dp" {{ old('payment_type') == 'dp' ? 'selected' : '' }}>DP (Down Payment)</option>
                            <option value="lunas" {{ old('payment_type') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="proof_of_payment" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Bukti Pembayaran (Opsional)</label>
                        <input type="file" name="proof_of_payment" id="proof_of_payment" accept="image/*"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                        <p class="text-xs text-gray-500 mt-1">Upload gambar bukti pembayaran (JPEG, PNG, JPG, GIF, max 2MB)</p>
                    </div>

                    <div class="space-y-2">
                        <label for="notes" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" id="notes" rows="3" placeholder="Informasi tambahan untuk fotografer..."
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 pt-6">
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 px-8 py-4 border border-gray-100 text-gray-400 rounded-2xl hover:bg-gray-50 hover:text-gray-600 transition-all text-center font-bold text-sm active:scale-95">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-2 px-8 py-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-black text-sm shadow-xl shadow-indigo-100 active:scale-95 uppercase tracking-widest">
                            Konfirmasi Reservasi
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-gray-400 hover:text-indigo-600 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>