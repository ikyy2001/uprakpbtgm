<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <span class="text-green-600 text-xl mr-3">✅</span>
                        <div class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <span class="text-red-600 text-xl mr-3">❌</span>
                        <div class="text-sm font-medium text-red-800">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

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

            <!-- Hero Banner Kemerdekaan (Landing Page Style) -->
            <div class="relative bg-[#D32F2F] text-white rounded-3xl p-6 sm:p-8 overflow-hidden shadow-lg border border-red-700/30">
                <!-- Background decorative elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-red-700/50 to-red-900/50 pointer-events-none"></div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/5 rounded-full filter blur-xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -right-12 w-60 h-60 bg-yellow-400/10 rounded-full filter blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="space-y-4">
                        <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/20">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-400"></span>
                            </span>
                            <span class="text-xs font-semibold tracking-wider uppercase text-yellow-300">
                                Edisi Kemerdekaan RI Ke-81 🇮🇩
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-none">
                            Selamat Datang, <span class="text-yellow-300">{{ Auth::user()->name }}</span>!
                        </h1>
                        <p class="text-sm text-red-100 max-w-xl leading-relaxed">
                            Bawa nama baik kelas <span class="font-bold text-white bg-white/20 px-2.5 py-0.5 rounded">{{ Auth::user()->kelas }}</span>! 
                            Silakan daftarkan dirimu ke cabang lomba dan pantau status kelolamu secara real-time.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('leaderboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-sm font-bold rounded-xl text-[#D32F2F] bg-white hover:bg-red-50 hover:shadow-lg active:scale-95 transition-all">
                            🏆 Klasemen Medali
                        </a>
                        <a href="#riwayat" class="inline-flex items-center justify-center px-5 py-3 border border-white/30 text-sm font-bold rounded-xl text-white hover:bg-white/10 active:scale-95 transition-all">
                            📋 Riwayat Anda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid (Admin Page Style) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Stat 1: Total Pendaftaran -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Cabang Diikuti</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-gray-800 mt-1">{{ $myRegistrations->count() }}</h3>
                        </div>
                        <span class="text-2xl bg-gray-50 p-2.5 rounded-xl border border-gray-100">📝</span>
                    </div>
                </div>
                <!-- Stat 2: Menunggu Verifikasi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menunggu Verifikasi</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-yellow-600 mt-1">{{ $myRegistrations->where('status', 'menunggu')->count() }}</h3>
                        </div>
                        <span class="text-2xl bg-yellow-50 p-2.5 rounded-xl border border-yellow-100">⏳</span>
                    </div>
                </div>
                <!-- Stat 3: Disetujui -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Telah Terverifikasi</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-green-600 mt-1">{{ $myRegistrations->where('status', 'terverifikasi')->count() }}</h3>
                        </div>
                        <span class="text-2xl bg-green-50 p-2.5 rounded-xl border border-green-100">✅</span>
                    </div>
                </div>
                <!-- Stat 4: Ditolak -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengajuan Ditolak</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-red-600 mt-1">{{ $myRegistrations->where('status', 'ditolak')->count() }}</h3>
                        </div>
                        <span class="text-2xl bg-red-50 p-2.5 rounded-xl border border-red-100">❌</span>
                    </div>
                </div>
            </div>

            <!-- Participant Info & Registration Form Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Profile Card (Left) -->
                <div class="lg:col-span-5 bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-4">
                            <span class="h-14 w-14 rounded-2xl bg-red-50 text-[#D32F2F] font-black flex items-center justify-center text-xl shadow-inner border border-red-100">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </span>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</h3>
                                <p class="text-xs text-gray-400 font-mono mt-0.5">NISN: {{ Auth::user()->nomor_induk }}</p>
                            </div>
                        </div>

                        <div class="mt-8 space-y-4 border-t border-gray-100 pt-6">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Kelas / Jurusan</span>
                                <span class="font-bold text-[#D32F2F] bg-red-50 px-3 py-1 rounded-lg border border-red-100">{{ Auth::user()->kelas }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Status Akses</span>
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-red-50 text-[#D32F2F] border border-red-100">Siswa / Peserta</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Email</span>
                                <span class="text-gray-700 font-medium">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Batas Lomba Diikuti</span>
                                <span class="font-bold text-gray-800">
                                    {{ $myRegistrations->whereIn('status', ['terverifikasi', 'menunggu'])->count() }} / 2 Cabang
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-xs text-red-750 bg-red-50 p-4 rounded-xl border border-red-100 leading-relaxed flex items-start space-x-2">
                        <span class="text-sm">💡</span>
                        <span><strong>Petunjuk</strong>: Setiap peserta hanya diizinkan untuk mendaftar maksimal <strong>2 cabang lomba</strong>. Data pendaftaran yang sudah dikirim akan diverifikasi oleh panitia.</span>
                    </div>
                </div>

                <!-- Registration Form Card (Right) -->
                <div class="lg:col-span-7 bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span>📝</span> Formulir Pendaftaran Lomba
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">Pilih cabang lomba kemerdekaan yang ingin diikuti oleh Anda.</p>
                    </div>

                    @if ($myRegistrations->whereIn('status', ['terverifikasi', 'menunggu'])->count() >= 2)
                        <div class="bg-red-50 border border-red-100 rounded-xl p-5 text-center space-y-3">
                            <span class="text-3xl block">🚫</span>
                            <h4 class="font-bold text-red-800 text-sm">Batas Pendaftaran Tercapai</h4>
                            <p class="text-xs text-red-700 leading-relaxed max-w-sm mx-auto">
                                Anda sudah terdaftar di 2 cabang lomba. Sesuai regulasi panitia, Anda tidak dapat mendaftar lagi kecuali membatalkan salah satu pendaftaran.
                            </p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('peserta.daftar') }}" class="space-y-6">
                            @csrf

                            <!-- Cabang Lomba Dropdown -->
                            <div>
                                <label for="lomba_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Cabang Lomba</label>
                                <select name="lomba_id" id="lomba_id" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-[#D32F2F] focus:ring-[#D32F2F] text-sm py-3 transition-colors" required>
                                    <option value="" disabled selected>-- Pilih Cabang Lomba --</option>
                                    @foreach ($lombas as $lomba)
                                        @php
                                            $isFull = $lomba->jumlah_pendaftar >= $lomba->batas_kuota_maksimal;
                                            $isRegistered = $myRegistrations->where('lomba_id', $lomba->id)->isNotEmpty();
                                        @endphp
                                        <option value="{{ $lomba->id }}" 
                                            @if($isFull || $isRegistered) disabled @endif>
                                            {{ $lomba->nama_lomba }} 
                                            ({{ $lomba->jumlah_pendaftar }}/{{ $lomba->batas_kuota_maksimal }} kuota)
                                            @if($isRegistered) -- [Sudah Terdaftar] @elseif($isFull) -- [Penuh] @endif
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-400 mt-2">
                                    Catatan: Cabang lomba bertanda [Penuh] atau [Sudah Terdaftar] tidak dapat dipilih.
                                </p>
                            </div>

                            <!-- Description Block for selected Lomba -->
                            <div id="lomba-details" class="bg-red-50/40 border border-red-100 rounded-xl p-4 hidden">
                                <h4 class="text-xs font-bold text-red-800 uppercase tracking-wider">Deskripsi Lomba:</h4>
                                <p id="lomba-desc" class="text-xs text-gray-600 mt-1.5 leading-relaxed"></p>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#D32F2F] hover:bg-red-700 shadow-md hover:shadow-lg active:scale-95 transition-all cursor-pointer">
                                    Kirim Pendaftaran Lomba 🚀
                                </button>
                            </div>
                        </form>
                    @endif
                </div>

            </div>

            <!-- History Table Card (Full Width) -->
            <div id="riwayat" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span>📋</span> Riwayat Pendaftaran Anda
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Daftar perlombaan yang Anda ajukan beserta status verifikasi terupdate.</p>
                </div>

                @if ($myRegistrations->isEmpty())
                    <div class="text-center py-12 text-gray-400 space-y-2">
                        <span class="text-4xl block">📝</span>
                        <p class="text-sm font-medium">Anda belum mendaftar di cabang lomba manapun.</p>
                        <p class="text-xs text-gray-450">Silakan pilih lomba di atas untuk mulai berpartisipasi.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-16">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Lomba</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kuota Maks</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal Daftar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-150">
                                @foreach ($myRegistrations as $reg)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $reg->lomba->nama_lomba }}</td>
                                        <td class="px-6 py-4 text-xs text-gray-500 max-w-xs truncate">{{ $reg->lomba->deskripsi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $reg->lomba->batas_kuota_maksimal }} Orang</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reg->created_at->timezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($reg->status === 'terverifikasi')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-150">
                                                    ● Terverifikasi
                                                </span>
                                            @elseif ($reg->status === 'menunggu')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-150">
                                                    ● Menunggu
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-150">
                                                    ● Ditolak
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Dropdown helper script to show description dynamically -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('lomba_id');
            const detailsBox = document.getElementById('lomba-details');
            const descPara = document.getElementById('lomba-desc');

            // Map Lomba ID to descriptions from Blade
            const descriptions = {
                @foreach ($lombas as $lomba)
                    "{{ $lomba->id }}": "{{ addslashes(str_replace(["\r", "\n"], ' ', $lomba->deskripsi)) }}",
                @endforeach
            };

            dropdown.addEventListener('change', function () {
                const selectedId = dropdown.value;
                if (selectedId && descriptions[selectedId]) {
                    descPara.textContent = descriptions[selectedId];
                    detailsBox.classList.remove('hidden');
                } else {
                    detailsBox.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
