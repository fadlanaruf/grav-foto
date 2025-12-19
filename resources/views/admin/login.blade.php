<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Gravity Studio</title>

    @vite('resources/css/app.css')

    <style>
        html, body {
            height: 100%;
        }
        body {
            background: radial-gradient(circle at top, #eef2ff, #f5f7fa 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Inter', sans-serif;
        }
        /* Glow lingkaran aesthetic */
        .halo::before {
            content: "";
            position: absolute;
            top: -120px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(99,102,241,0.28), transparent 70%);
            filter: blur(40px);
            z-index: -1;
        }
    </style>
</head>

<body>

    <div class="relative halo w-full max-w-md p-8 bg-white/70 backdrop-blur-xl rounded-2xl shadow-[0_0_80px_-20px_rgba(0,0,0,0.15)] border border-white/40">

        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-xl bg-indigo-500 flex items-center justify-center 
                    text-white font-bold text-2xl shadow-lg group-hover:scale-105 transition">
                    G
                </div>

                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Gravity<span class="text-indigo-600">Studio</span>
                </h1>
            </a>

            <p class="mt-3 text-gray-600 text-sm">
                Ini Admin.
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur 
                       shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 backdrop-blur 
                       shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">

                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit"
                    class="w-full py-3 rounded-xl bg-indigo-600 text-white font-bold text-base
                    shadow-lg hover:bg-indigo-700 hover:shadow-xl transition-all duration-150">
                Masuk
            </button>
        </form>

        <!-- Register -->
        <div class="mt-8 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ url('/register') }}"
               class="font-bold text-indigo-600 hover:text-indigo-800">
                Daftar Sekarang
            </a>
        </div>
    </div>

</body>
</html>
