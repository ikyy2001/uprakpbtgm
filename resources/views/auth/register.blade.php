@extends('layouts.landing')

@section('title', 'Daftar - RuangLomba')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#FAF8F5]">
    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-150 grid grid-cols-1 md:grid-cols-12 min-h-[600px]">
        <!-- Left Side: Brand & Visuals (Desktop) -->
        <div class="hidden md:flex md:col-span-5 bg-gradient-to-br from-[#D32F2F] to-[#B71C1C] text-white p-10 flex-col justify-between relative overflow-hidden bg-grid-white-pattern">
            <div class="absolute inset-0 bg-radial-glow pointer-events-none"></div>
            
            <!-- Top badge -->
            <div class="relative z-10">
                <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/20">
                    <span class="flex h-1.5 w-1.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-yellow-400"></span>
                    </span>
                    <span class="text-[10px] font-bold tracking-wider uppercase text-yellow-300">
                        RI KE-81 🇮🇩
                    </span>
                </div>
            </div>

            <!-- Middle Text -->
            <div class="relative z-10 my-auto space-y-4">
                <h3 class="text-3xl font-black tracking-tight leading-none">
                    Daftar <br>Ruang<span class="text-yellow-300">Lomba</span>
                </h3>
                <p class="text-xs text-red-100 leading-relaxed font-light">
                    Daftarkan perwakilan kelasmu sekarang dan ikuti berbagai cabang lomba kemerdekaan yang seru dan sportif!
                </p>
                <div class="space-y-2 pt-2 text-[11px] text-red-50/90 font-medium">
                    <div class="flex items-center space-x-2">
                        <span>🏆</span>
                        <span>Rebut Piala Bergilir Juara Umum</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>🪢</span>
                        <span>12+ Cabang Lomba Seru</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>🔥</span>
                        <span>Tunjukkan Kekompakan Kelasmu!</span>
                    </div>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="relative z-10 text-[10px] text-red-200">
                &copy; {{ date('Y') }} RuangLomba Team. All rights reserved.
            </div>
        </div>

        <!-- Right Side: Administrator Notice -->
        <div class="col-span-1 md:col-span-7 p-8 sm:p-10 flex flex-col justify-center bg-white">
            <div class="text-center space-y-6 max-w-sm mx-auto">
                <span class="text-5xl block animate-bounce">🏫</span>
                
                <div class="space-y-2">
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Pendaftaran Mandiri Ditutup</h2>
                    <p class="text-sm text-gray-500">Pembuatan akun mandiri telah dinonaktifkan oleh administrator.</p>
                </div>
                
                <div class="bg-red-50 border border-red-150 rounded-2xl p-5 text-left space-y-3 shadow-inner">
                    <h4 class="font-bold text-red-800 text-sm flex items-center">
                        <span class="mr-2">ℹ️</span> Petunjuk Pendaftaran Akun
                    </h4>
                    <p class="text-xs text-red-750 leading-relaxed">
                        Untuk mendapatkan akun kelas baru, silakan menghubungi administrator **SMK PLUS PELITA NUSANTARA** atau hubungi panitia melalui email:
                    </p>
                    <a href="mailto:info@smkpluspnb.sch.id" class="text-xs font-bold text-blue-600 hover:underline block break-all font-mono">
                        info@smkpluspnb.sch.id
                    </a>
                </div>
                
                <div class="pt-4 space-y-3">
                    <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#D32F2F] hover:bg-red-700 hover:shadow-lg active:scale-[0.98] transition-all duration-150 cursor-pointer">
                        Masuk ke Akun Anda
                    </a>
                    
                    <a href="/" class="w-full inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-sm font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 active:scale-[0.98] transition-all duration-150 cursor-pointer">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

