@extends('layouts.landing')

@section('title', 'RuangLomba - Pendaftaran Lomba 17-an Pelita Nusantara')

@section('content')
<!-- Hero Section -->
<section id="beranda" class="relative bg-[#D32F2F] text-white pt-12 pb-20 md:py-32 overflow-hidden bg-grid-white-pattern">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 bg-radial-glow pointer-events-none"></div>
    <div class="absolute top-1/4 right-0 w-96 h-96 bg-white/5 rounded-full filter blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="absolute bottom-10 left-10 w-72 h-72 bg-yellow-400/10 rounded-full filter blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Text Column -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Promo Badge -->
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/20">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-400"></span>
                    </span>
                    <span class="text-xs font-semibold tracking-wider uppercase text-yellow-300">
                        Edisi Kemerdekaan RI Ke-81 🇮🇩
                    </span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-none text-white">
                    Siap Jadi Juara? <br>
                    <span class="text-yellow-300">Ayo Daftar Lomba 17-an!</span>
                </h1>
                
                <p class="text-base sm:text-lg text-red-50/90 max-w-xl leading-relaxed">
                    Sambut hari kemerdekaan dengan penuh sportivitas dan kegembiraan! Daftarkan kelasmu, ikuti berbagai cabang lomba seru, dan perebutkan gelar juara umum Pelita Nusantara.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="#daftar" class="inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-base font-bold rounded-xl text-[#D32F2F] bg-white hover:bg-red-50 hover:shadow-xl hover:shadow-red-950/20 active:scale-95 transition-all duration-200">
                        Daftar Lomba Sekarang
                        <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#lomba" class="inline-flex items-center justify-center px-6 py-3.5 border border-white/30 text-base font-bold rounded-xl text-white hover:bg-white/10 active:scale-95 transition-all duration-200">
                        Lihat Cabang Lomba
                    </a>
                </div>

                <!-- Info Counters -->
                <div class="grid grid-cols-3 gap-4 pt-8 border-t border-white/10 max-w-md">
                    <div>
                        <p class="text-3xl font-black text-yellow-300">12+</p>
                        <p class="text-xs text-red-100/70">Cabang Lomba</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-yellow-300">32</p>
                        <p class="text-xs text-red-100/70">Kelas Terdaftar</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-yellow-300">Rp 5M+</p>
                        <p class="text-xs text-red-100/70">Total Hadiah & Cup</p>
                    </div>
                </div>
            </div>

            <!-- Right Image Column -->
            <div class="lg:col-span-5 relative">
                <!-- Stacked design card decoration -->
                <div class="absolute inset-0 bg-yellow-400 rounded-2xl transform rotate-3 scale-95 opacity-20 filter blur-sm"></div>
                <div class="absolute inset-0 bg-white rounded-2xl transform -rotate-2 scale-100 opacity-10"></div>
                
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20 transform rotate-1 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ asset('images/hero-17an.png') }}" alt="Siswa Merayakan Kemerdekaan" class="w-full h-auto object-cover aspect-[4/3] bg-red-950">
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-6 text-left">
                        <span class="inline-block bg-[#D32F2F] text-white text-[10px] font-bold tracking-widest uppercase px-2 py-0.5 rounded mb-2">Dokumentasi 17-an</span>
                        <h3 class="text-white text-base font-bold">Keseruan perayaan kemerdekaan tahun lalu</h3>
                        <p class="text-gray-300 text-xs mt-0.5">Semangat membara perwakilan kelas XI IPA 3</p>
                    </div>
                </div>

                <!-- Floating badges -->
                <div class="absolute -top-6 -left-6 bg-yellow-400 text-red-950 font-black p-4 rounded-2xl shadow-lg border-2 border-white text-center transform -rotate-12 animate-float">
                    <p class="text-xs uppercase tracking-wider">Juara Umum</p>
                    <p class="text-lg">Piala Bergilir</p>
                </div>
                <div class="absolute -bottom-6 -right-4 bg-white text-red-600 font-extrabold px-4 py-2.5 rounded-full shadow-lg border-2 border-red-500 text-xs flex items-center space-x-1.5 animate-float-delayed">
                    <span>🔥</span>
                    <span>100% Sportif</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 1: Bawa Nama Baik Kelasmu -->
<section id="lomba" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Info Column -->
            <div class="lg:col-span-6 space-y-6 text-left order-2 lg:order-1">
                <div class="relative">
                    <span class="text-sm font-bold text-[#D32F2F] uppercase tracking-widest block mb-1">Berjuang Bersama</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                        Bawa Nama Baik <br>
                        <span class="text-[#D32F2F] underline decoration-yellow-400 decoration-wavy decoration-2">Kelasmu!</span>
                    </h2>
                </div>
                <p class="text-base text-gray-600 leading-relaxed">
                    Setiap partisipasi dan kemenangan di cabang lomba akan menyumbangkan poin akumulatif bagi kelas Anda. Ajak teman sekelasmu untuk mendaftar, berlatih bersama, dan rebut supremasi tertinggi sebagai Juara Umum Kemerdekaan!
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3 p-3 bg-red-50 rounded-xl border border-red-100">
                        <span class="text-xl">🏆</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Poin Juara I</h4>
                            <p class="text-xs text-gray-500">+100 Poin untuk kelas</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-xl border border-yellow-100">
                        <span class="text-xl">🥈</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Poin Juara II</h4>
                            <p class="text-xs text-gray-500">+75 Poin untuk kelas</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-xl border border-blue-100">
                        <span class="text-xl">🥉</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Poin Juara III</h4>
                            <p class="text-xs text-gray-500">+50 Poin untuk kelas</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-xl border border-green-100">
                        <span class="text-xl">🎖️</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Poin Partisipasi</h4>
                            <p class="text-xs text-gray-500">+10 Poin per pendaftar</p>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="#daftar" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#3B82F6] hover:bg-blue-600 shadow-md active:scale-95 transition-all duration-200">
                        Daftar Sekarang →
                    </a>
                </div>
            </div>

            <!-- Right Image Column -->
            <div class="lg:col-span-6 order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute inset-0 bg-[#D32F2F]/10 rounded-2xl transform rotate-2"></div>
                    <img src="{{ asset('images/tug-of-war.png') }}" alt="Siswa Bermain Tarik Tambang" class="w-full h-auto object-cover rounded-2xl shadow-xl border border-gray-100 relative z-10 transform -rotate-1 hover:rotate-0 transition-transform duration-500 bg-red-900 aspect-[4/3]">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 2: Pantau Jadwal & Skor Real-Time -->
<section id="jadwal" class="py-20 bg-gray-50 border-t border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Dynamic Visual Hub -->
            <div class="lg:col-span-6 flex justify-center items-center">
                <!-- SVG Connected Circle Graphic -->
                <div class="relative w-80 h-80 sm:w-96 sm:h-96 flex items-center justify-center">
                    <!-- Central Hub -->
                    <div class="relative z-20 w-28 h-28 sm:w-32 sm:h-32 bg-white rounded-full shadow-2xl border-4 border-[#D32F2F] flex flex-col items-center justify-center p-2 text-center animate-pulse-slow">
                        <span class="text-3xl sm:text-4xl">⏱️</span>
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">Live Score</span>
                        <span class="text-xs font-black text-[#D32F2F]">REAL-TIME</span>
                    </div>

                    <!-- Outer orbit lines -->
                    <div class="absolute w-64 h-64 sm:w-72 sm:h-72 border-2 border-dashed border-gray-300 rounded-full animate-[spin_40s_linear_infinite]"></div>
                    <div class="absolute w-80 h-80 sm:w-90 sm:h-90 border border-dotted border-[#D32F2F]/40 rounded-full animate-[spin_60s_linear_infinite_reverse]"></div>

                    <!-- Orbiting Nodes -->
                    <!-- Node 1: Tarik Tambang -->
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float">
                        <span class="text-lg">🪢</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Tarik Tambang</div>
                    </div>
                    <!-- Node 2: Balap Karung -->
                    <div class="absolute top-1/4 right-0 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float-delayed">
                        <span class="text-lg">🥔</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Balap Karung</div>
                    </div>
                    <!-- Node 3: Makan Kerupuk -->
                    <div class="absolute bottom-1/4 right-2 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float">
                        <span class="text-lg">🍘</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Makan Kerupuk</div>
                    </div>
                    <!-- Node 4: Panjat Pinang -->
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float-delayed">
                        <span class="text-lg">🌴</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Panjat Pinang</div>
                    </div>
                    <!-- Node 5: Futsal Sarung -->
                    <div class="absolute bottom-1/4 left-2 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float">
                        <span class="text-lg">⚽</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Futsal Sarung</div>
                    </div>
                    <!-- Node 6: Egrang -->
                    <div class="absolute top-1/4 left-0 z-30 bg-white p-2.5 rounded-full shadow-lg border border-gray-100 text-center animate-float-delayed">
                        <span class="text-lg">🪵</span>
                        <div class="text-[9px] font-bold text-gray-800 hidden sm:block">Egrang</div>
                    </div>
                </div>
            </div>

            <!-- Right Info Column -->
            <div class="lg:col-span-6 space-y-6 text-left">
                <span class="text-sm font-bold text-[#D32F2F] uppercase tracking-widest block mb-1">Informasi Digital</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Pantau Jadwal & <br>
                    Skor secara <span class="text-[#D32F2F]">Real-Time!</span>
                </h2>
                <p class="text-base text-gray-600 leading-relaxed">
                    Tidak perlu lagi ke papan pengumuman fisik untuk melihat jadwal tanding atau perolehan skor. Akses langsung bagan pertandingan, catatan skor grup, dan klasemen perolehan medali kelas secara instan dari perangkat Anda.
                </p>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="text-sm text-gray-700 font-medium">Bagan tanding otomatis ter-update pasca pertandingan</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="text-sm text-gray-700 font-medium">Notifikasi jadwal tanding masuk via akun kelas</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="text-sm text-gray-700 font-medium">Klasemen medali interaktif yang dinamis</span>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="{{ route('leaderboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#3B82F6] hover:bg-blue-600 shadow-md active:scale-95 transition-all duration-200">
                        Cek Klasemen Lomba →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promo Banner 1: Pantau Keseruan dari Mana Saja -->
<section class="bg-[#D32F2F] text-white py-16 relative overflow-hidden bg-grid-white-pattern border-y border-white/10">
    <div class="absolute inset-0 bg-radial-glow pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 space-y-6">
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
            Pantau Keseruan dari Mana Saja
        </h2>
        <p class="text-base sm:text-lg text-red-100 max-w-2xl mx-auto leading-relaxed">
            Platform kami telah dioptimalkan agar responsif diakses dari HP android paling kentang sekalipun hingga PC monitor ultra-wide. Cepat, ringan, dan bebas lag saat melihat persaingan antar kelas.
        </p>
        <div class="flex justify-center space-x-8 pt-4 text-red-100/70 text-xs uppercase tracking-wider font-semibold">
            <div class="flex items-center space-x-1.5">
                <span>📱</span>
                <span>Mobile Friendly</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <span>⚡</span>
                <span>Super Ringan</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <span>🔒</span>
                <span>Aman & Stabil</span>
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 3: Sistem Transparan & Adil -->
<section id="sistem" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Info Column -->
            <div class="lg:col-span-6 space-y-6 text-left order-2 lg:order-1">
                <span class="text-sm font-bold text-[#D32F2F] uppercase tracking-widest block mb-1">Sportivitas Utama</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Sistem Penilaian <br>
                    <span class="text-[#D32F2F] underline decoration-yellow-400 decoration-wavy decoration-2">Transparan & Adil</span>
                </h2>
                <p class="text-base text-gray-600 leading-relaxed">
                    Kami menjunjung tinggi kejujuran. Skor akhir divalidasi langsung oleh koordinator wasit independen dan riwayat pertandingan tersimpan aman di database digital kami. Siapapun bisa memantau detail poin per pertandingan tanpa ada yang disembunyikan.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <span class="text-xl">📢</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Transparansi Wasit</h4>
                            <p class="text-xs text-gray-500">Nama wasit dan detail penalti dicatat lengkap untuk setiap laga.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span class="text-xl">🛡️</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Keamanan Data</h4>
                            <p class="text-xs text-gray-500">Data poin dikunci ketat setelah kedua perwakilan kelas tanda tangan digital.</p>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="#sistem" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#3B82F6] hover:bg-blue-600 shadow-md active:scale-95 transition-all duration-200">
                        Pelajari Sistem →
                    </a>
                </div>
            </div>

            <!-- Right Schematic Column -->
            <div class="lg:col-span-6 order-1 lg:order-2 flex justify-center">
                <!-- SVG Diagram representing transparency -->
                <div class="relative w-80 h-80 sm:w-96 sm:h-96 bg-gray-50 rounded-3xl border border-gray-100 flex items-center justify-center p-6 shadow-inner">
                    <!-- Triangle Node Pattern -->
                    <svg class="absolute w-full h-full p-8" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 20 L20 70 L80 70 Z" stroke="rgba(211, 47, 47, 0.2)" stroke-width="1.5" stroke-dasharray="3 3"/>
                        <circle cx="50" cy="20" r="1.5" fill="#D32F2F"/>
                        <circle cx="20" cy="70" r="1.5" fill="#D32F2F"/>
                        <circle cx="80" cy="70" r="1.5" fill="#D32F2F"/>
                    </svg>

                    <!-- Central Shield Node -->
                    <div class="relative z-10 bg-white p-5 rounded-2xl shadow-xl border border-red-100 flex flex-col items-center text-center animate-float max-w-[150px]">
                        <span class="text-3xl">🛡️</span>
                        <span class="text-xs font-bold text-gray-900 mt-2">Sistem Adil</span>
                        <p class="text-[9px] text-gray-400 mt-0.5">Verified Data Logs</p>
                    </div>

                    <!-- Top Node: Input Wasit -->
                    <div class="absolute top-12 bg-white p-3 rounded-xl shadow-md border border-gray-100 flex items-center space-x-2 animate-float-delayed">
                        <span class="text-lg">📢</span>
                        <div class="text-left">
                            <h5 class="text-[10px] font-black text-gray-800">1. Input Wasit</h5>
                            <p class="text-[8px] text-gray-400">Pencatatan langsung di lapangan</p>
                        </div>
                    </div>

                    <!-- Left Node: Verifikasi Kelas -->
                    <div class="absolute bottom-16 left-6 bg-white p-3 rounded-xl shadow-md border border-gray-100 flex items-center space-x-2 animate-float">
                        <span class="text-lg">📝</span>
                        <div class="text-left">
                            <h5 class="text-[10px] font-black text-gray-800">2. Verifikasi Kelas</h5>
                            <p class="text-[8px] text-gray-400">Konfirmasi persetujuan kapten</p>
                        </div>
                    </div>

                    <!-- Right Node: Publikasi Skor -->
                    <div class="absolute bottom-16 right-6 bg-white p-3 rounded-xl shadow-md border border-gray-100 flex items-center space-x-2 animate-float-delayed">
                        <span class="text-lg">📲</span>
                        <div class="text-left">
                            <h5 class="text-[10px] font-black text-gray-800">3. Publikasi Skor</h5>
                            <p class="text-[8px] text-gray-400">Tayang di dashboard real-time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sponsor Logo Section: Diselenggarakan Oleh -->
<section class="py-12 bg-gray-50 border-y border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">
            Diselenggarakan Oleh & Didukung Oleh Sponsor Resmi
        </h3>
        
        <!-- Logo Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center opacity-70">
            <!-- Google -->
            <div class="h-8 flex items-center hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google Logo" class="h-6 object-contain grayscale hover:grayscale-0 transition duration-300">
            </div>
            <!-- Microsoft -->
            <div class="h-8 flex items-center hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg" alt="Microsoft Logo" class="h-6 object-contain grayscale hover:grayscale-0 transition duration-300">
            </div>
            <!-- Slack -->
            <div class="h-8 flex items-center hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Slack_icon_2019.svg" alt="Slack Logo" class="h-8 w-8 object-contain grayscale hover:grayscale-0 transition duration-300 mr-2">
                <span class="font-extrabold text-xl text-gray-700 tracking-tight grayscale hover:grayscale-0 transition duration-300">slack</span>
            </div>
            <!-- Apple -->
            <div class="h-8 flex items-center hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple Logo" class="h-7 object-contain grayscale hover:grayscale-0 transition duration-300">
            </div>
        </div>
    </div>
</section>

<!-- Feature Section 4: Bagikan Momen Keseruan Kelasmu! -->
<section class="bg-[#D32F2F] text-white py-20 relative overflow-hidden bg-grid-white-pattern">
    <div class="absolute inset-0 bg-radial-glow pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Network Visual Column -->
            <div class="lg:col-span-6 flex justify-center order-2 lg:order-1">
                <div class="relative w-80 h-80 sm:w-96 sm:h-96 flex items-center justify-center bg-white/5 rounded-full border border-white/10 backdrop-blur-sm">
                    <!-- Centered Social Hub -->
                    <div class="relative z-20 w-24 h-24 bg-white rounded-full shadow-xl flex items-center justify-center border-4 border-yellow-400 animate-pulse-slow">
                        <span class="text-3xl">📸</span>
                    </div>

                    <!-- Connect Lines SVG -->
                    <svg class="absolute w-full h-full p-4" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 50 L20 20 M50 50 L80 20 M50 50 L15 65 M50 50 L85 65 M50 50 L50 85" stroke="rgba(255, 255, 255, 0.2)" stroke-width="1.5" stroke-dasharray="4 4"/>
                    </svg>

                    <!-- Orbiting Apps/Socials Icons -->
                    <!-- Instagram -->
                    <div class="absolute top-12 left-12 bg-white/10 backdrop-blur-md p-3 rounded-full border border-white/20 text-center animate-float">
                        <span class="text-xl">📸</span>
                    </div>
                    <!-- Whatsapp -->
                    <div class="absolute top-12 right-12 bg-white/10 backdrop-blur-md p-3 rounded-full border border-white/20 text-center animate-float-delayed">
                        <span class="text-xl">💬</span>
                    </div>
                    <!-- Gallery -->
                    <div class="absolute bottom-24 left-6 bg-white/10 backdrop-blur-md p-3 rounded-full border border-white/20 text-center animate-float">
                        <span class="text-xl">🖼️</span>
                    </div>
                    <!-- Video -->
                    <div class="absolute bottom-24 right-6 bg-white/10 backdrop-blur-md p-3 rounded-full border border-white/20 text-center animate-float-delayed">
                        <span class="text-xl">🎥</span>
                    </div>
                    <!-- Trophy -->
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 bg-white/10 backdrop-blur-md p-3 rounded-full border border-white/20 text-center animate-float">
                        <span class="text-xl">🏆</span>
                    </div>
                </div>
            </div>

            <!-- Right Info Column -->
            <div class="lg:col-span-6 space-y-6 text-left order-1 lg:order-2">
                <span class="text-sm font-bold text-yellow-300 uppercase tracking-widest block mb-1">Momen Bersama</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Bagikan Momen <br>
                    Keseruan Kelasmu!
                </h2>
                <p class="text-base text-red-50/90 leading-relaxed font-light">
                    Keseruan 17-an tidak lengkap tanpa aksi heboh supporter di pinggir lapangan atau yel-yel kreatif kelasmu. Ambil fotomu, unggah langsung ke galeri aplikasi RuangLomba, dan biarkan seluruh sekolah menjadi saksi kebersamaan kelasmu!
                </p>
                <div class="pt-2">
                    <a href="#galeri" class="inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-sm font-bold rounded-xl text-[#D32F2F] bg-white hover:bg-red-50 hover:shadow-xl hover:shadow-red-950/20 active:scale-95 transition-all duration-200">
                        Unggah Momen Seru
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section: Suara Warga Pelita Nusantara -->
<section id="testimoni" class="py-20 bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-12">
        <div class="space-y-4">
            <span class="text-sm font-bold text-[#D32F2F] uppercase tracking-widest">Testimoni Pengguna</span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900">
                Suara Warga Pelita Nusantara
            </h2>
            <div class="w-24 h-1 bg-[#D32F2F] mx-auto rounded-full"></div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: White Background (Teacher) -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col justify-between text-left space-y-6 transform hover:-translate-y-2 transition-transform duration-300">
                <div class="space-y-4">
                    <span class="text-5xl text-[#D32F2F] font-serif leading-none block">“</span>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Aplikasi pendaftaran ini mempermudah tugas kami selaku guru pamong dan koordinator kesiswaan. Pendataan siswa yang ikut lomba jadi otomatis, teratur, dan yang terpenting: hemat kertas (paperless). Luar biasa!
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-4 border-t border-gray-50">
                    <!-- Initial Avatar -->
                    <span class="h-10 w-10 rounded-full bg-red-100 text-[#D32F2F] font-black flex items-center justify-center text-sm shadow-inner">
                        BU
                    </span>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Bapak Utama S.Pd</h4>
                        <p class="text-xs text-gray-500">Wakasek Kesiswaan</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Blue Background (OSIS Coordinator) -->
            <div class="bg-[#3B82F6] text-white p-8 rounded-2xl shadow-xl flex flex-col justify-between text-left space-y-6 transform hover:-translate-y-2 transition-transform duration-300">
                <div class="space-y-4">
                    <span class="text-5xl text-yellow-300 font-serif leading-none block">“</span>
                    <p class="text-blue-50 text-sm leading-relaxed">
                        Dulu kalau jadi panitia 17-an pusing banget rekap jadwal dan hitung poin juara umum manual di Excel. Sekarang tinggal input skor, klasemen ter-update sendiri secara real-time. Teman-teman OSIS jadi tidak kelelahan!
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-4 border-t border-blue-400/30">
                    <!-- Initial Avatar -->
                    <span class="h-10 w-10 rounded-full bg-white text-[#3B82F6] font-black flex items-center justify-center text-sm shadow-inner">
                        RA
                    </span>
                    <div>
                        <h4 class="font-bold text-white text-sm">Rian Adi</h4>
                        <p class="text-xs text-blue-100/70">Ketua Panitia OSIS</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Blue Background (Student) -->
            <div class="bg-[#3B82F6] text-white p-8 rounded-2xl shadow-xl flex flex-col justify-between text-left space-y-6 transform hover:-translate-y-2 transition-transform duration-300">
                <div class="space-y-4">
                    <span class="text-5xl text-yellow-300 font-serif leading-none block">“</span>
                    <p class="text-blue-50 text-sm leading-relaxed">
                        Seru banget sumpah! Kami sekelas bisa pantau live score tim futsal kami waktu lagi jam istirahat. Jadi tahu butuh berapa emas lagi biar kelas kami (XII IPS 2) bisa mengalahkan XII IPA 1 di klasemen umum!
                    </p>
                </div>
                <div class="flex items-center space-x-3 pt-4 border-t border-blue-400/30">
                    <!-- Initial Avatar -->
                    <span class="h-10 w-10 rounded-full bg-white text-[#3B82F6] font-black flex items-center justify-center text-sm shadow-inner">
                        DS
                    </span>
                    <div>
                        <h4 class="font-bold text-white text-sm">Dewi Sartika</h4>
                        <p class="text-xs text-blue-100/70">Siswa Kelas XII IPS 2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Register CTA Section / Placeholder for Phase 2 -->
<section id="daftar" class="py-24 bg-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
        <span class="text-sm font-bold text-[#D32F2F] uppercase tracking-widest">Ayo Bergabung</span>
        <h2 class="text-3xl sm:text-5xl font-black text-gray-900 tracking-tight leading-none">
            Daftarkan Tim Kelasmu Sekarang!
        </h2>
        <p class="text-base sm:text-lg text-gray-600 max-w-xl mx-auto leading-relaxed">
            Pendaftaran akan ditutup dalam waktu dekat. Pastikan seluruh berkas anggota tim sudah lengkap untuk mempermudah verifikasi panitia.
        </p>

        <!-- CTA Cards for fast Registration or checking rules -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 max-w-2xl mx-auto">
            <!-- Registration Card -->
            <div class="bg-gray-50 hover:bg-red-50/50 p-6 rounded-2xl border border-gray-200 hover:border-red-200 text-left transition-all duration-300 flex flex-col justify-between">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">Pendaftaran Kelas</h3>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Pendaftaran resmi tim perwakilan kelas untuk seluruh cabang lomba 17 Agustus.</p>
                </div>
                <a href="{{ auth()->check() ? (auth()->user()->role === 'panitia' ? route('panitia.dashboard') : route('peserta.dashboard')) : route('register') }}" class="mt-6 inline-flex w-full items-center justify-center px-4 py-2.5 text-xs font-bold text-white bg-[#D32F2F] hover:bg-red-700 rounded-lg shadow-md active:scale-95 transition-all cursor-pointer text-center">
                    Mulai Daftar Kelas →
                </a>
            </div>

            <!-- Rules Card -->
            <div class="bg-gray-50 hover:bg-blue-50/50 p-6 rounded-2xl border border-gray-200 hover:border-blue-200 text-left transition-all duration-300 flex flex-col justify-between">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">Panduan & Syarat</h3>
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">Unduh buku panduan regulasi, denda kecurangan, dan syarat sah peserta didik.</p>
                </div>
                <button class="mt-6 inline-flex w-full items-center justify-center px-4 py-2.5 text-xs font-bold text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 rounded-lg shadow-sm active:scale-95 transition-all cursor-pointer">
                    Unduh Panduan PDF 📥
                </button>
            </div>
        </div>
        
        <p class="text-xs text-gray-400 mt-4">
            Catatan: Pendaftaran hanya bisa dilakukan oleh perwakilan ketua kelas atau wali kelas terdaftar.
        </p>
    </div>
</section>
@endsection
