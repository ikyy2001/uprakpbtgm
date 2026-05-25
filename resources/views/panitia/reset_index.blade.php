<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reset Data Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Breadcrumbs -->
            <div>
                <a href="{{ route('panitia.dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors flex items-center">
                    ← Kembali ke Dasbor Utama
                </a>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex items-start">
                        <span class="text-red-600 text-xl mr-3 mt-0.5">⚠️</span>
                        <div>
                            <h4 class="text-sm font-bold text-red-800">Terdapat kesalahan input:</h4>
                            <ul class="list-disc list-inside text-xs text-red-700 mt-1 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Reset Panel -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-black text-gray-900 flex items-center gap-2">
                        <span>⚠️</span> Peringatan Reset Data
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Gunakan fitur ini secara bijaksana. Tindakan reset bersifat merusak dan menghapus database secara permanen.</p>
                </div>

                <form method="POST" action="{{ route('panitia.reset.process') }}" class="space-y-8">
                    @csrf

                    <!-- Options Grid -->
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Data yang Ingin Di-reset:</label>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Option 1: Reset Bagan -->
                            <label class="relative flex items-start p-4 rounded-xl border border-gray-200 hover:border-red-200 bg-gray-50/50 hover:bg-red-50/10 cursor-pointer transition-all duration-200">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="reset_option" value="bagan" checked class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <span class="font-extrabold text-gray-900 block">Reset Bagan Pertandingan</span>
                                    <span class="text-xs text-gray-500 block mt-0.5">Menghapus seluruh jadwal bagan pertandingan tanding yang telah di-generate secara acak.</span>
                                </div>
                            </label>

                            <!-- Option 2: Reset Skor -->
                            <label class="relative flex items-start p-4 rounded-xl border border-gray-200 hover:border-red-200 bg-gray-50/50 hover:bg-red-50/10 cursor-pointer transition-all duration-200">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="reset_option" value="skor" class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <span class="font-extrabold text-gray-900 block">Reset Hasil & Skor Tanding (Leaderboard)</span>
                                    <span class="text-xs text-gray-500 block mt-0.5">Mengosongkan pemenang dari seluruh pertandingan dan mengembalikan status ke "Belum Mulai" tanpa menghapus struktur bagan pertandingan.</span>
                                </div>
                            </label>

                            <!-- Option 3: Reset Pendaftaran -->
                            <label class="relative flex items-start p-4 rounded-xl border border-gray-200 hover:border-red-200 bg-gray-50/50 hover:bg-red-50/10 cursor-pointer transition-all duration-200">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="reset_option" value="pendaftaran" class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <span class="font-extrabold text-gray-900 block">Reset Pendaftaran Peserta</span>
                                    <span class="text-xs text-gray-500 block mt-0.5">Menghapus seluruh data pengajuan pendaftaran siswa (terverifikasi, menunggu, ditolak) beserta seluruh bagan pertandingan.</span>
                                </div>
                            </label>

                            <!-- Option 4: Reset Semua -->
                            <label class="relative flex items-start p-4 rounded-xl border-2 border-red-200 bg-red-50/10 hover:bg-red-50/30 cursor-pointer transition-all duration-200">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="reset_option" value="semua" class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <span class="font-black text-red-800 block">Reset Seluruh Data (Semua)</span>
                                    <span class="text-xs text-red-750 block mt-0.5">Menghapus seluruh pendaftaran peserta, jadwal bagan tanding, serta riwayat klasemen medali/skor. Mengembalikan sistem ke kondisi awal (reregrasi).</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Confirmation Checkbox -->
                    <div class="bg-red-50 border border-red-150 p-4 rounded-2xl flex items-start space-x-3">
                        <div class="flex items-center h-5 mt-0.5">
                            <input id="confirm_reset" name="confirm_reset" type="checkbox" value="1" required class="h-4 w-4 text-[#D32F2F] focus:ring-[#D32F2F] border-gray-300 rounded">
                        </div>
                        <label for="confirm_reset" class="text-xs text-red-800 leading-relaxed cursor-pointer font-semibold">
                            Saya mengerti dan menyetujui bahwa tindakan ini bersifat destruktif permanen, tidak dapat dibatalkan, dan data yang terhapus tidak dapat dikembalikan lagi.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-sm font-bold rounded-xl text-white bg-red-600 hover:bg-red-700 hover:shadow-lg active:scale-95 transition-all cursor-pointer">
                            🚨 Jalankan Eksekusi Reset Data
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
