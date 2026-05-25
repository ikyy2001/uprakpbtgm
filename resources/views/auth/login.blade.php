@extends('layouts.landing')

@section('title', 'Masuk - RuangLomba')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#FAF8F5]">
    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-150 grid grid-cols-1 md:grid-cols-12 min-h-[550px]">
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
                    Ruang<span class="text-yellow-300">Lomba</span>
                </h3>
                <p class="text-xs text-red-100 leading-relaxed font-light">
                    Sambut hari kemerdekaan dengan penuh sportivitas! Masuk untuk mengelola tim kelasmu, pantau skor real-time, dan raih kemenangan bersama.
                </p>
                <div class="space-y-2 pt-2 text-[11px] text-red-50/90 font-medium">
                    <div class="flex items-center space-x-2">
                        <span>🏆</span>
                        <span>Akumulasi Poin Juara Kelas</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>⏱️</span>
                        <span>Update Skor Real-time</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>📢</span>
                        <span>Sistem Adil & Transparan</span>
                    </div>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="relative z-10 text-[10px] text-red-200">
                &copy; {{ date('Y') }} RuangLomba Team. All rights reserved.
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-span-1 md:col-span-7 p-8 sm:p-10 flex flex-col justify-center bg-white">
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 tracking-tight">Selamat Datang Kembali!</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan masuk ke akun kelas atau panitia Anda.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Alamat Email</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 text-sm">
                            📧
                        </span>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username" 
                               class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:border-[#D32F2F] transition-colors"
                               placeholder="nama@sekolah.sch.id">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center">
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-[#D32F2F] hover:underline" href="{{ route('password.request') }}">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 text-sm">
                            🔒
                        </span>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password" 
                               class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:border-[#D32F2F] transition-colors"
                               placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                        Ingat Saya
                    </label>
                </div>

                <!-- Action Button -->
                <div>
                    <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3.5 border border-transparent text-sm font-bold rounded-xl text-white bg-[#D32F2F] hover:bg-red-700 hover:shadow-lg active:scale-[0.98] transition-all duration-150 cursor-pointer">
                        Masuk Sekarang →
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center pt-2">
                    <p class="text-sm text-gray-500">
                        Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="font-bold text-[#3B82F6] hover:underline">
                            Daftar Kelas Baru
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

