<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Panitia - Manajemen Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

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

            <!-- Statistics Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Stat 1: Total Pendaftar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendaftar</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-gray-800 mt-1">{{ $stats['total_pendaftar'] }}</h3>
                        </div>
                        <span class="text-2xl bg-gray-50 p-2.5 rounded-xl border border-gray-100">📝</span>
                    </div>
                </div>
                <!-- Stat 2: Pending -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Belum Diverifikasi</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-yellow-600 mt-1">{{ $stats['pending'] }}</h3>
                        </div>
                        <span class="text-2xl bg-yellow-50 p-2.5 rounded-xl border border-yellow-100">⏳</span>
                    </div>
                </div>
                <!-- Stat 3: Approved -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Disetujui / Terverifikasi</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-green-600 mt-1">{{ $stats['terverifikasi'] }}</h3>
                        </div>
                        <span class="text-2xl bg-green-50 p-2.5 rounded-xl border border-green-100">✅</span>
                    </div>
                </div>
                <!-- Stat 4: Rejected -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ditolak</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-red-600 mt-1">{{ $stats['ditolak'] }}</h3>
                        </div>
                        <span class="text-2xl bg-red-50 p-2.5 rounded-xl border border-red-100">❌</span>
                    </div>
                </div>
            </div>

            <!-- Main Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Table List of Registrations (Left) -->
                <div class="lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Pengajuan Pendaftaran Masuk</h3>
                        <p class="text-xs text-gray-500 mt-1">Daftar verifikasi peserta didik untuk cabang perlombaan.</p>
                    </div>

                    @if ($registrations->isEmpty())
                        <div class="text-center py-12 text-gray-400">
                            <span class="text-4xl block mb-2">📥</span>
                            <p class="text-sm font-medium">Belum ada pengajuan pendaftaran masuk.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-12">No</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Peserta</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Lomba</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-4 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider w-40">Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($registrations as $reg)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-400">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $reg->user->name }}</div>
                                                <div class="text-xs text-gray-400">Kelas {{ $reg->user->kelas }} | NISN: {{ $reg->user->nomor_induk }}</div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                                {{ $reg->lomba->nama_lomba }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                @if ($reg->status === 'terverifikasi')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-150">
                                                        Terverifikasi
                                                    </span>
                                                @elseif ($reg->status === 'menunggu')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-150">
                                                        Menunggu
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-150">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                @if ($reg->status === 'menunggu')
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <!-- Setujui Form -->
                                                        <form method="POST" action="{{ route('panitia.pendaftaran.verifikasi', $reg->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="terverifikasi">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg shadow-sm active:scale-95 transition-all cursor-pointer">
                                                                Setujui
                                                            </button>
                                                        </form>
                                                        <!-- Tolak Form -->
                                                        <form method="POST" action="{{ route('panitia.pendaftaran.verifikasi', $reg->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-sm active:scale-95 transition-all cursor-pointer">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-400 font-medium">Sudah Diproses</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Cabang Lomba Management List (Right) -->
                <div class="lg:col-span-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Cabang Perlombaan</h3>
                        <p class="text-xs text-gray-500 mt-1">Kelola kuota, peserta, dan undian bagan tanding.</p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($lombas as $lomba)
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-gray-200 transition-all flex flex-col justify-between space-y-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="font-extrabold text-gray-800 text-sm leading-tight">{{ $lomba->nama_lomba }}</h4>
                                        <p class="text-xs text-gray-400 mt-0.5">Maks Quota: {{ $lomba->batas_kuota_maksimal }} Peserta</p>
                                    </div>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-600 font-mono">
                                        {{ $lomba->jumlah_peserta }} Terverifikasi
                                    </span>
                                </div>
                                <div class="pt-2 border-t border-gray-200/50 flex justify-between items-center">
                                    <a href="{{ route('lomba.bagan', $lomba->id) }}" target="_blank" class="text-xs font-bold text-gray-500 hover:text-gray-800 transition-colors flex items-center">
                                        👁️ Lihat Bagan Publik
                                    </a>
                                    <a href="{{ route('panitia.lomba.show', $lomba->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm active:scale-95 transition-all">
                                        Kelola Lomba →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
