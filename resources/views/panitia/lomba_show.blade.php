<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Cabang Lomba') }}: {{ $lomba->nama_lomba }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Back Link & Action Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <a href="{{ route('panitia.dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors flex items-center">
                    ← Kembali ke Dasbor Utama
                </a>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('lomba.bagan', $lomba->id) }}" target="_blank" class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm active:scale-95 transition-all">
                        👁️ Pratinjau Bagan Publik
                    </a>
                    
                    <!-- Generate Bagan Form Button -->
                    @php
                        $hasStarted = $matches->whereIn('status', ['berlangsung', 'selesai'])->isNotEmpty();
                    @endphp
                    <form method="POST" action="{{ route('panitia.lomba.generate-bagan', $lomba->id) }}">
                        @csrf
                        <button type="submit" 
                                @if($hasStarted) disabled @endif
                                class="px-5 py-2 text-sm font-bold text-white rounded-xl shadow-md transition-all @if($hasStarted) bg-gray-400 cursor-not-allowed opacity-75 @else bg-blue-600 hover:bg-blue-700 active:scale-95 cursor-pointer @endif">
                            @if($hasStarted)
                                🔒 Bagan Sedang Berjalan / Selesai
                            @else
                                ⚡ Generate Ulang Bagan Pertandingan
                            @endif
                        </button>
                    </form>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <span class="text-green-600 text-xl mr-3">✅</span>
                        <div class="text-sm font-medium text-green-800">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <span class="text-red-600 text-xl mr-3">❌</span>
                        <div class="text-sm font-medium text-red-800">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            <!-- Main Panel Details Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Competition Details Card (Left) -->
                <div class="lg:col-span-4 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Detail Cabang Lomba</h3>
                        <p class="text-xs text-gray-500 mt-1">Spesifikasi kuota dan regulasi lomba.</p>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-100 text-sm">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nama Lomba</span>
                            <span class="font-extrabold text-gray-950 block mt-1">{{ $lomba->nama_lomba }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Deskripsi Lomba</span>
                            <p class="text-gray-600 text-xs mt-1 leading-relaxed">{{ $lomba->deskripsi }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Batas Kuota</span>
                                <span class="font-bold text-gray-800 font-mono mt-1 block">{{ $lomba->batas_kuota_maksimal }} Orang</span>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Peserta Terverifikasi</span>
                                <span class="font-bold text-green-600 font-mono mt-1 block">
                                    {{ $registrations->where('status', 'terverifikasi')->count() }} Orang
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl space-y-2">
                        <h4 class="text-xs font-bold text-blue-800">Roster Peserta Terverifikasi:</h4>
                        @php
                            $verifiedRegs = $registrations->where('status', 'terverifikasi');
                        @endphp
                        @if ($verifiedRegs->isEmpty())
                            <p class="text-xs text-blue-600">Belum ada peserta yang disetujui untuk lomba ini.</p>
                        @else
                            <ol class="list-decimal list-inside text-xs text-blue-800 space-y-2">
                                @foreach ($verifiedRegs as $vReg)
                                    <li class="flex justify-between items-center gap-2">
                                        <span class="truncate mr-2">{{ $vReg->user->name }} ({{ $vReg->user->kelas }})</span>
                                        <div class="flex items-center space-x-2 flex-shrink-0">
                                            <!-- Disqualify Action -->
                                            <form method="POST" action="{{ route('panitia.lomba.diskualifikasi', [$lomba->id, $vReg->user->id]) }}" onsubmit="return confirm('Apakah Anda yakin ingin mendiskualifikasi peserta ini?')">
                                                @csrf
                                                <button type="submit" class="text-[10px] text-yellow-600 hover:text-yellow-800 font-bold hover:underline cursor-pointer">
                                                    Dis
                                                </button>
                                            </form>
                                            <span class="text-gray-300 text-[10px]">|</span>
                                            <!-- Kick Action -->
                                            <form method="POST" action="{{ route('panitia.lomba.kick', [$lomba->id, $vReg->user->id]) }}" onsubmit="return confirm('Apakah Anda yakin ingin meng-kick (menghapus) peserta ini dari lomba?')">
                                                @csrf
                                                <button type="submit" class="text-[10px] text-red-650 hover:text-red-800 font-bold hover:underline cursor-pointer">
                                                    Kick
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>

                <!-- Matches / Bracket Data Panel (Right) -->
                <div class="lg:col-span-8 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Bagan Pertandingan Ter-Generate</h3>
                        <p class="text-xs text-gray-500 mt-1">Daftar pertandingan babak 1 (Penyisihan) hasil pengundian sistem.</p>
                    </div>

                    @if ($matches->isEmpty())
                        <div class="text-center py-16 text-gray-400 space-y-3">
                            <span class="text-4xl block">🪢</span>
                            <h4 class="font-bold text-gray-500 text-sm">Belum Ada Bagan Pertandingan</h4>
                            <p class="text-xs text-gray-400 max-w-sm mx-auto leading-relaxed">
                                Klik tombol **Generate Ulang Bagan Pertandingan** di atas untuk mengacak peserta terverifikasi dan menyusun pertandingan babak 1.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-16">Match</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Babak</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Peserta 1</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Peserta 2</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Status / Pemenang</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100 text-sm">
                                    @foreach ($matches as $match)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-4 py-4 whitespace-nowrap font-bold text-gray-400 font-mono">#{{ $loop->iteration }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-xs font-bold text-gray-700">
                                                Babak {{ $match->babak }} (Penyisihan)
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="font-bold text-gray-900">{{ $match->peserta1->name }}</span>
                                                <span class="text-xs text-gray-400 block">{{ $match->peserta1->kelas }}</span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                @if ($match->peserta2)
                                                    <span class="font-bold text-gray-900">{{ $match->peserta2->name }}</span>
                                                    <span class="text-xs text-gray-400 block">{{ $match->peserta2->kelas }}</span>
                                                @else
                                                    <span class="px-2 py-0.5 text-xs font-bold bg-yellow-100 text-yellow-800 rounded-lg">
                                                        BYE (Lolos Otomatis)
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                @if ($match->status === 'selesai' && $match->pemenang)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-150">
                                                        👑 Pemenang: {{ $match->pemenang->name }}
                                                    </span>
                                                @else
                                                    <form method="POST" action="{{ route('panitia.pertandingan.set-winner', $match->id) }}" class="flex items-center space-x-2">
                                                        @csrf
                                                        <select name="pemenang_id" required class="text-xs rounded-lg border-gray-250 py-1 focus:ring-blue-500 focus:border-blue-500 max-w-[120px]">
                                                            <option value="" disabled selected>Pemenang</option>
                                                            <option value="{{ $match->peserta_1_id }}">{{ $match->peserta1->name }}</option>
                                                            @if ($match->peserta2)
                                                                <option value="{{ $match->peserta_2_id }}">{{ $match->peserta2->name }}</option>
                                                            @endif
                                                        </select>
                                                        <button type="submit" class="text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white px-2 py-1.5 rounded-lg active:scale-95 transition-all cursor-pointer">
                                                            Simpan
                                                        </button>
                                                    </form>
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
    </div>
</x-app-layout>
