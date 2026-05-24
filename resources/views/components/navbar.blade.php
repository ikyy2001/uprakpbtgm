<nav class="bg-[#D32F2F] text-white sticky top-0 z-50 shadow-md transition-all duration-300 border-b border-white/10" id="main-navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center space-x-2 group">
                    <span class="bg-white text-[#D32F2F] p-1.5 rounded-lg font-black tracking-wider text-xl shadow-inner group-hover:scale-105 transition-transform duration-200">
                        🇮🇩
                    </span>
                    <span class="font-extrabold text-xl sm:text-2xl tracking-tight text-white group-hover:text-red-100 transition-colors">
                        Ruang<span class="text-yellow-300">Lomba</span>
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/#beranda" class="text-sm font-semibold text-white/90 hover:text-white transition-colors py-2 border-b-2 border-transparent hover:border-white">
                    Beranda
                </a>
                <a href="/#lomba" class="text-sm font-semibold text-white/90 hover:text-white transition-colors py-2 border-b-2 border-transparent hover:border-white">
                    Lomba
                </a>
                <a href="/#jadwal" class="text-sm font-semibold text-white/90 hover:text-white transition-colors py-2 border-b-2 border-transparent hover:border-white">
                    Jadwal
                </a>
                <a href="{{ route('leaderboard') }}" class="text-sm font-semibold text-white/90 hover:text-white transition-colors py-2 border-b-2 border-transparent hover:border-white">
                    Papan Skor (Leaderboard)
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-semibold text-white border border-white/30 rounded-lg hover:bg-white/10 transition-all duration-200">
                        Dasbor
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2 text-sm font-bold text-[#D32F2F] bg-white rounded-lg hover:bg-red-50 hover:shadow-lg active:scale-95 transition-all duration-200 cursor-pointer">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-white border border-white/30 rounded-lg hover:bg-white/10 transition-all duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-bold text-[#D32F2F] bg-white rounded-lg hover:bg-red-50 hover:shadow-lg active:scale-95 transition-all duration-200">
                        Daftar Lomba
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <!-- Icon Open (hamburger) -->
                    <svg id="hamburger-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon Close -->
                    <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden md:hidden bg-[#B71C1C] border-t border-white/10 transition-all duration-300" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/#beranda" class="block px-3 py-2.5 rounded-md text-base font-medium text-white hover:bg-white/10 transition-all">
                Beranda
            </a>
            <a href="/#lomba" class="block px-3 py-2.5 rounded-md text-base font-medium text-white hover:bg-white/10 transition-all">
                Lomba
            </a>
            <a href="/#jadwal" class="block px-3 py-2.5 rounded-md text-base font-medium text-white hover:bg-white/10 transition-all">
                Jadwal
            </a>
            <a href="{{ route('leaderboard') }}" class="block px-3 py-2.5 rounded-md text-base font-medium text-white hover:bg-white/10 transition-all">
                Papan Skor (Leaderboard)
            </a>
        </div>
        <div class="pt-4 pb-4 border-t border-white/10 px-5 space-y-3">
            @auth
                <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2.5 text-base font-semibold text-white border border-white/30 rounded-md hover:bg-white/10 transition-all">
                    Dasbor
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-center px-4 py-2.5 text-base font-bold text-[#D32F2F] bg-white rounded-md hover:bg-red-50 transition-all shadow-md cursor-pointer">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 text-base font-semibold text-white border border-white/30 rounded-md hover:bg-white/10 transition-all">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2.5 text-base font-bold text-[#D32F2F] bg-white rounded-md hover:bg-red-50 transition-all shadow-md">
                    Daftar Lomba
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        btn.addEventListener('click', function () {
            const isExpanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', !isExpanded);
            menu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Hide mobile menu on link click
        const links = menu.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            });
        });

        // Add scroll effect to navbar
        const navbar = document.getElementById('main-navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg', 'bg-[#B71C1C]');
                navbar.classList.remove('bg-[#D32F2F]');
            } else {
                navbar.classList.add('bg-[#D32F2F]');
                navbar.classList.remove('shadow-lg', 'bg-[#B71C1C]');
            }
        });
    });
</script>
