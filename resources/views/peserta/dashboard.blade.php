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

            <!-- Participant Info & Registration Form Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Profile Card (Left) -->
                <div class="lg:col-span-5 bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-4">
                            <span class="h-14 w-14 rounded-2xl bg-blue-50 text-blue-600 font-black flex items-center justify-center text-xl shadow-inner border border-blue-100">
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
                                <span class="font-bold text-gray-800 bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">{{ Auth::user()->kelas }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Status Akses</span>
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Siswa / Peserta</span>
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

                    <div class="mt-8 text-xs text-gray-400 bg-gray-50 p-3.5 rounded-xl border border-gray-100 leading-relaxed">
                        💡 **Petunjuk**: Setiap peserta hanya diizinkan untuk mendaftar maksimal **2 cabang lomba**. Data pendaftaran yang sudah dikirim akan diverifikasi oleh panitia.
                    </div>
                </div>

                <!-- Registration Form Card (Right) -->
                <div class="lg:col-span-7 bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Formulir Pendaftaran Lomba</h3>
                        <p class="text-xs text-gray-500 mt-1">Pilih cabang lomba kemerdekaan yang ingin diikuti oleh Anda.</p>
                    </div>

                    @if ($myRegistrations->whereIn('status', ['terverifikasi', 'menunggu'])->count() >= 2)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 text-center space-y-3">
                            <span class="text-3xl block">🚫</span>
                            <h4 class="font-bold text-yellow-800 text-sm">Batas Pendaftaran Tercapai</h4>
                            <p class="text-xs text-yellow-700 leading-relaxed max-w-sm mx-auto">
                                Anda sudah terdaftar di 2 cabang lomba. Sesuai regulasi panitia, Anda tidak dapat mendaftar lagi kecuali membatalkan salah satu pendaftaran.
                            </p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('peserta.daftar') }}" class="space-y-6">
                            @csrf

                            <!-- Cabang Lomba Dropdown -->
                            <div>
                                <label for="lomba_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Cabang Lomba</label>
                                <select name="lomba_id" id="lomba_id" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-3 transition-colors" required>
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
                            <div id="lomba-details" class="bg-gray-50 border border-gray-150 rounded-xl p-4 hidden">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Deskripsi Lomba:</h4>
                                <p id="lomba-desc" class="text-xs text-gray-600 mt-1.5 leading-relaxed"></p>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-md active:scale-98 transition-all cursor-pointer">
                                    Kirim Pendaftaran 🚀
                                </button>
                            </div>
                        </form>
                    @endif
                </div>

            </div>

            <!-- History Table Card (Full Width) -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6">
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Riwayat Pendaftaran Anda</h3>
                    <p class="text-xs text-gray-500 mt-1">Daftar perlombaan yang Anda ajukan beserta status verifikasi terupdate.</p>
                </div>

                @if ($myRegistrations->isEmpty())
                    <div class="text-center py-12 text-gray-400 space-y-2">
                        <span class="text-4xl block">📝</span>
                        <p class="text-sm font-medium">Anda belum mendaftar di cabang lomba manapun.</p>
                        <p class="text-xs text-gray-400">Silakan pilih lomba di atas untuk mulai berpartisipasi.</p>
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
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                                    ● Terverifikasi
                                                </span>
                                            @elseif ($reg->status === 'menunggu')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                                    ● Menunggu
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
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
