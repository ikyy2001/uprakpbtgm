<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RuangLomba - Pendaftaran Lomba Kemerdekaan 17-an')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Aplikasi pendaftaran lomba 17 Agustus terintegrasi. Daftar, pantau jadwal, dan lihat skor real-time untuk perayaan kemerdekaan kelas Anda.">
    <meta name="keywords" content="lomba 17-an, pendaftaran lomba, hari kemerdekaan, agustusan, real-time score">
    <meta name="author" content="RuangLomba Team">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="RuangLomba - Pendaftaran Lomba Kemerdekaan 17-an">
    <meta property="og:description" content="Aplikasi pendaftaran lomba 17 Agustus terintegrasi. Daftar, pantau jadwal, dan lihat skor real-time untuk perayaan kemerdekaan kelas Anda.">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FAF8F5] text-gray-900 overflow-x-hidden selection:bg-red-600 selection:text-white">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />
</body>
</html>
