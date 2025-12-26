<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.01em; }
        
        /* Custom Radio Styling */
        .form-radio {
            appearance: none; width: 1.25rem; height: 1.25rem;
            border: 2px solid #E2E8F0; border-radius: 50%;
            transition: all 0.2s; cursor: pointer; position: relative;
        }
        .form-radio:checked {
            border-color: #4F46E5; background-color: #4F46E5;
            box-shadow: inset 0 0 0 3px white;
        }

        /* Animations */
        .animate-fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    @include('partials.header')

    <div class="min-h-screen pt-28 pb-20 px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-4xl font-black tracking-tight text-gray-900">
                    Buat <span class="text-indigo-600">Reservasi</span>
                </h1>
                <p class="text-gray-500 mt-2 font-medium">Abadikan momen berharga Anda bersama tim profesional kami.</p>
            </div>

            @if ($errors->any())
                <div class="flex items-start p-5 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-3xl animate-pulse">
                    <svg class="w-6 h-6 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-black uppercase tracking-wider text-[10px] mb-1">Terjadi Kesalahan</p>
                        <ul class="list-disc list-inside font-medium opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg font-bold text-sm">1</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Pilih Paket Foto</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                            <div class="relative">
                                <select name="category_filter" id="category_filter" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach(['corporate', 'ultah', 'dokumentasi', 'lamaran', 'martupol', 'personal', 'keluarga', 'maternity', 'wedding'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category_filter', request('category')) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <div id="location_filter_container" class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Sesi</label>
                            <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                @foreach(['all' => 'SEMUA', 'indoor' => 'INDOOR', 'outdoor' => 'OUTDOOR'] as $val => $label)
                                    <label class="inline-flex items-center cursor-pointer group">
                                        <input type="radio" name="location_filter" value="{{ $val }}" {{ $val == 'all' ? 'checked' : '' }} class="form-radio" />
                                        <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors uppercase">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="wedding_subcategory" class="space-y-2 hidden animate-fade-in">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jenis Acara Wedding</label>
                        <div class="flex flex-wrap gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            @foreach(['prewedding' => 'PRE-WEDDING', 'akad' => 'AKAD NIKAH', 'resepsi' => 'RESEPSI'] as $val => $label)
                                <label class="inline-flex items-center cursor-pointer group" data-subcategory-value="{{ $val }}">
                                    <input type="radio" name="subcategory" value="{{ $val }}" class="form-radio" />
                                    <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors uppercase">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div id="indoor_studio_option" class="space-y-2 hidden animate-fade-in">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Foto di Studio?</label>
                        <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="is_studio" value="1" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors uppercase">YA, DI STUDIO</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="is_studio" value="0" checked class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors uppercase">TIDAK (LOKASI LUAR)</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="photo_package_id" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Layanan Tersedia</label>
                        <div class="relative">
                            <select name="photo_package_id" id="photo_package_id" required disabled
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                                <option value="">— Pilih Kategori Dahulu —</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" 
                                            data-category="{{ $package->category ?: 'personal' }}" 
                                            data-location="{{ $package->location ?: 'indoor' }}"
                                            data-subcategory="{{ $package->subcategory }}">
                                        {{ $package->name }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg font-bold text-sm">2</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Detail Pemesanan</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 space-y-2">
                            <label for="name" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Nama lengkap Anda"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">WhatsApp</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="0812..."
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div class="space-y-2">
                            <label for="number_of_people" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Peserta</label>
                            <div class="relative">
                                <input type="number" name="number_of_people" id="number_of_people" value="{{ old('number_of_people', 1) }}" min="1" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">
                                <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400">ORANG</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="photo_date" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Sesi</label>
                            <input type="date" name="photo_date" id="photo_date" value="{{ old('photo_date', request('photo_date')) }}" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div class="space-y-2">
                            <label for="photo_time" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jam Sesi</label>
                            <input type="time" name="photo_time" id="photo_time" value="{{ old('photo_time', request('photo_time')) }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div id="address_container" class="md:col-span-2 space-y-2">
                            <label for="address" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Sesi / Alamat Domisili</label>
                            <textarea name="address" id="address" rows="2" required placeholder="Alamat lengkap lokasi sesi..."
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg font-bold text-sm">3</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Metode Pembayaran</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="payment_method" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Metode</label>
                            <select name="payment_method" id="payment_method" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 appearance-none outline-none font-bold text-sm text-gray-700">
                                <option value="">— Pilih Metode —</option>
                                @foreach($paymentMethods as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="payment_type" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe</label>
                            <select name="payment_type" id="payment_type" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 appearance-none outline-none font-bold text-sm text-gray-700">
                                <option value="">— Pilih Tipe —</option>
                                <option value="dp">DP (Down Payment)</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label for="proof_of_payment" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Bukti Transfer (Opsional)</label>
                            <input type="file" name="proof_of_payment" id="proof_of_payment" accept="image/*"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label for="notes" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Catatan Tambahan</label>
                            <textarea name="notes" id="notes" rows="3" placeholder="Informasi tambahan..."
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-sm text-gray-700">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <a href="{{ route('dashboard') }}" class="flex-1 px-8 py-5 border border-gray-200 text-gray-400 rounded-3xl hover:bg-gray-50 transition-all text-center font-black text-xs uppercase tracking-widest">
                        Batal
                    </a>
                    <button type="submit" class="flex-2 px-8 py-5 bg-indigo-600 text-white rounded-3xl hover:bg-indigo-700 transition-all font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 active:scale-95">
                        Konfirmasi Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dom = {
                cat: document.getElementById('category_filter'),
                pkg: document.getElementById('photo_package_id'),
                locs: document.querySelectorAll('input[name="location_filter"]'),
                locContainer: document.getElementById('location_filter_container'),
                wedding: document.getElementById('wedding_subcategory'),
                studio: document.getElementById('indoor_studio_option'),
                addr: document.getElementById('address_container'),
                addrInput: document.getElementById('address'),
                studios: document.querySelectorAll('input[name="is_studio"]'),
                subRadios: document.querySelectorAll('input[name="subcategory"]')
            };

            /** 1. Filter packages based on category, location, and subcategory */
            const runFilter = () => {
                const category = dom.cat.value;
                const isWedding = category === 'wedding';
                const location = document.querySelector('input[name="location_filter"]:checked')?.value || 'all';
                const subcategory = document.querySelector('input[name="subcategory"]:checked')?.value || null;
                const urlPkg = new URLSearchParams(window.location.search).get('photo_package_id');

                if (!category) {
                    dom.pkg.disabled = true;
                    if (!urlPkg) dom.pkg.selectedIndex = 0;
                    return;
                }

                dom.pkg.disabled = false;
                let hasMatch = false;
                
                Array.from(dom.pkg.options).forEach((opt, i) => {
                    if (i === 0) return;
                    
                    const matchCat = opt.dataset.category === category;
                    const matchLoc = isWedding ? true : (location === 'all' || opt.dataset.location === location);
                    const matchSub = isWedding ? (opt.dataset.subcategory === subcategory) : true;
                    
                    const finalMatch = matchCat && matchLoc && matchSub;
                    
                    opt.style.display = finalMatch ? '' : 'none';
                    if (finalMatch) hasMatch = true;
                });

                if (!hasMatch || (dom.pkg.selectedOptions[0]?.style.display === 'none' && dom.pkg.value !== urlPkg)) {
                    dom.pkg.selectedIndex = 0;
                }
            };

            /** 2. Toggle UI elements visibility */
            const updateUI = () => {
                const category = dom.cat.value;
                const isWedding = category === 'wedding';
                const location = document.querySelector('input[name="location_filter"]:checked')?.value || 'all';
                const isStudio = document.querySelector('input[name="is_studio"]:checked')?.value === '1';

                // Permintaan: Jika Wedding, Location Filter dan Studio Option ditiadakan
                dom.locContainer.classList.toggle('hidden', isWedding);
                dom.wedding.classList.toggle('hidden', !isWedding);
                
                // Studio option hanya muncul jika NON-Wedding dan lokasi Indoor
                dom.studio.classList.toggle('hidden', isWedding || location !== 'indoor');
                
                // Address logic: Wedding wajib isi alamat (venue), Non-wedding sembunyi jika di Studio
                const hideAddress = !isWedding && location === 'indoor' && isStudio;
                dom.addr.classList.toggle('hidden', hideAddress);
                dom.addrInput.required = !hideAddress;
            };

            /** 3. Show notification for selected package */
            const showSelectedMsg = (opt) => {
                if (!opt || opt.value === "") return;
                const title = document.querySelector('h1');
                const existing = document.getElementById('pkg-msg');
                if (existing) existing.remove();

                const name = opt.textContent.split(' (')[0];
                const price = opt.textContent.match(/Rp ([\d.,]+)/)?.[0];
                
                const msg = document.createElement('div');
                msg.id = 'pkg-msg';
                msg.className = 'flex items-center p-4 mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in';
                msg.innerHTML = `
                    <div class="flex-1">
                        <p class="font-bold text-sm">Paket Terpilih: ${name}</p>
                        <p class="text-xs font-bold text-emerald-600">${price}</p>
                    </div>
                `;
                title.after(msg);
            };

            /** 4. Initialization */
            const init = () => {
                const urlPkgId = new URLSearchParams(window.location.search).get('photo_package_id');
                if (urlPkgId) {
                    const opt = dom.pkg.querySelector(`option[value="${urlPkgId}"]`);
                    if (opt) {
                        dom.cat.value = opt.dataset.category;
                        if (opt.dataset.category === 'wedding' && opt.dataset.subcategory) {
                             const subRad = document.querySelector(`input[name="subcategory"][value="${opt.dataset.subcategory}"]`);
                             if (subRad) subRad.checked = true;
                        } else {
                            const locRad = document.querySelector(`input[name="location_filter"][value="${opt.dataset.location}"]`);
                            if (locRad) locRad.checked = true;
                        }
                        dom.pkg.value = urlPkgId;
                        showSelectedMsg(opt);
                    }
                }
                updateUI();
                runFilter();
            };

            // Event Listeners
            dom.cat.addEventListener('change', () => {
                if (dom.cat.value === 'wedding') {
                    if (!document.querySelector('input[name="subcategory"]:checked')) {
                        const pre = document.querySelector('input[name="subcategory"][value="prewedding"]');
                        if (pre) pre.checked = true;
                    }
                }
                updateUI();
                runFilter();
            });

            [...dom.locs, ...dom.studios, ...dom.subRadios].forEach(el => {
                el.addEventListener('change', () => {
                    updateUI();
                    runFilter();
                });
            });

            dom.pkg.addEventListener('change', (e) => {
                showSelectedMsg(e.target.options[e.target.selectedIndex]);
            });

            init();
        });
    </script>
</body>
</html>