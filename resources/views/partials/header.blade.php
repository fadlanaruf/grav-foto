<!-- ================= HEADER ================= -->
<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- KIRI: LOGO -->
        <a href="/" class="flex items-center order-1">
            <img src="{{ asset('logo.png') }}" class="h-10 w-auto" alt="Logo">
        </a>

        <!-- TENGAH: MENU DESKTOP -->
        <nav class="hidden md:flex justify-center space-x-10 text-sm font-semibold text-gray-600 order-2">
            <a href="/" class="hover:text-indigo-600 transition">Beranda</a>
            <a href="{{ route('packages.index') }}" class="hover:text-indigo-600 transition">Paket</a>
            <a href="{{ route('galeri') }}" class="hover:text-indigo-600 transition">Galeri</a>
            <a href="/#tracking" class="hover:text-indigo-600 transition">Lacak Reservasi</a>
            <a href="https://wa.me/62xxxxxxxx" class="hover:text-indigo-600 transition">Hubungi</a>
        </nav>

        <!-- KANAN: PROFIL + TOGGLE MOBILE -->
        <div class="flex items-center gap-4 order-3">

            @auth
            <!-- PROFIL DESKTOP -->
            <div class="relative hidden md:block">
                <button id="profile-toggle"
                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600
                               flex items-center justify-center hover:bg-indigo-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>

                <!-- DROPDOWN DESKTOP -->
                <div id="profile-menu" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 mb-1">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Akun Saya</p>
                        <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    </div>

                    <div class="p-1">
                        <a href="{{ route('reservations.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                            <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Riwayat Reservasi</span>
                        </a>

                        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                            <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="font-semibold">Profil Saya</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-500 rounded-xl hover:bg-red-50 transition group">
                                <div class="p-2 bg-red-50 rounded-lg group-hover:bg-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </div>
                                <span class="font-semibold">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth

            @guest
            <!-- TOMBOL MASUK (GUEST) -->
            <a href="{{ route('login') }}"
               class="hidden md:block px-6 py-2.5 rounded-full bg-indigo-600 text-white text-sm font-bold
                      hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                Masuk
            </a>
            @endguest

            <!-- TOGGLE MOBILE -->
            <button id="mobile-toggle" class="md:hidden w-10 h-10 flex items-center justify-center hover:bg-gray-100 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- MOBILE DROPDOWN -->
    <div id="mobile-dropdown" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden top-full">
        <div class="p-1">
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="font-semibold">Beranda</span>
            </a>

            <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="font-semibold">Paket</span>
            </a>

            <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="font-semibold">Galeri</span>
            </a>

            <a href="/#tracking" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <span class="font-semibold">Lacak Reservasi</span>
            </a>

            <a href="https://wa.me/6285265421321" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <span class="font-semibold">Hubungi</span>
            </a>

            @auth
            <div class="border-t border-gray-100 my-1"></div>

            <a href="{{ route('reservations.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="font-semibold">Riwayat Reservasi</span>
            </a>

            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                <div class="p-2 bg-gray-100 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="font-semibold">Profil Saya</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-500 rounded-xl hover:bg-red-50 transition group">
                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Logout</span>
                </button>
            </form>
            @endauth
            @guest
            <div class="border-t border-gray-100 my-1"></div>

            <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-indigo-600 rounded-xl hover:bg-indigo-50 transition group">
                <div class="p-2 bg-indigo-50 rounded-lg group-hover:bg-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <span class="font-semibold">Masuk</span>
            </a>
            @endguest
        </div>
    </div>
</header>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileDropdown = document.getElementById('mobile-dropdown');
    const profileToggle = document.getElementById('profile-toggle');
    const profileMenu = document.getElementById('profile-menu');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            mobileDropdown.classList.toggle('hidden');
        });
    }

    if (profileToggle) {
        profileToggle.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });
    }

    document.addEventListener('click', (e) => {
        if (profileMenu && !profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
        if (mobileDropdown && !mobileToggle.contains(e.target) && !mobileDropdown.contains(e.target)) {
            mobileDropdown.classList.add('hidden');
        }
    });
});
</script>

<script>
function handleReservation() {
    @auth
        window.location.href = '{{ route("reservations.create") }}';
    @else
        alert('Silakan login terlebih dahulu untuk melakukan reservasi.');
        window.location.href = '{{ route("login") }}';
    @endauth
}
</script>