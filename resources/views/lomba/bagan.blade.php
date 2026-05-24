@extends('layouts.landing')

@section('title', 'Bagan Pertandingan ' . $lomba->nama_lomba . ' - RuangLomba')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#D32F2F] text-white">
                🏆 BAGAN TURNAMEN RESMI
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-none">
                Bagan Pertandingan: <span class="text-[#D32F2F]">{{ $lomba->nama_lomba }}</span>
            </h1>
            <p class="text-sm sm:text-base text-gray-500 leading-relaxed">
                Pantau jadwal pertandingan, lawan tanding, dan pemenang dari setiap babak secara real-time. Semangat sportivitas dan raih juara!
            </p>
            <div class="w-16 h-1 bg-yellow-400 mx-auto rounded-full mt-2"></div>
        </div>

        <!-- Details Info Card -->
        <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm max-w-xl mx-auto grid grid-cols-3 gap-4 text-center">
            <div>
                <span class="text-xs text-gray-400 uppercase tracking-wider font-bold block">Status</span>
                <span class="text-sm font-extrabold text-green-600 block mt-1">● Berjalan</span>
            </div>
            <div class="border-x border-gray-100">
                <span class="text-xs text-gray-400 uppercase tracking-wider font-bold block">Total Laga</span>
                <span class="text-sm font-extrabold text-gray-800 block mt-1">{{ $rounds->flatten()->count() }} Pertandingan</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 uppercase tracking-wider font-bold block">Kuota Peserta</span>
                <span class="text-sm font-extrabold text-gray-800 block mt-1">{{ $lomba->batas_kuota_maksimal }} Orang</span>
            </div>
        </div>

        @if ($rounds->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-gray-100 py-16 px-6 text-center max-w-xl mx-auto space-y-4 shadow-sm">
                <span class="text-5xl block">⏳</span>
                <h3 class="text-lg font-bold text-gray-800">Bagan Belum Di-Generate</h3>
                <p class="text-xs text-gray-500 leading-relaxed max-w-sm mx-auto">
                    Panitia belum melakukan pengundian bagan pertandingan untuk cabang lomba ini. Silakan hubungi panitia penyelenggara untuk informasi lebih lanjut.
                </p>
                <div class="pt-4">
                    <a href="/" class="inline-flex items-center justify-center px-5 py-2.5 text-xs font-bold text-white bg-[#D32F2F] hover:bg-red-700 rounded-lg shadow-md active:scale-95 transition-all">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else
            <!-- Tree Bracket Wrapper -->
            <div class="bg-white rounded-2xl border border-gray-150 p-8 shadow-sm overflow-x-auto">
                <div class="flex flex-col md:flex-row items-center md:items-stretch justify-center gap-8 md:gap-12 lg:gap-16 min-w-[700px] py-6">
                    
                    <!-- Round 1: Penyisihan -->
                    <div class="flex flex-col justify-center space-y-8 w-64">
                        <div class="text-center font-bold text-gray-500 uppercase tracking-wider text-xs border-b border-gray-100 pb-2.5">
                            Babak 1: Penyisihan
                        </div>
                        <div class="flex flex-col justify-around h-full space-y-6">
                            @foreach ($rounds->get(1, []) as $match)
                                <div class="relative group">
                                    <!-- Match Card Container -->
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:border-gray-300 transition-all">
                                        <!-- Header of Card -->
                                        <div class="bg-gray-100/80 px-3 py-1.5 border-b border-gray-200 flex justify-between items-center text-[10px] font-bold text-gray-500 font-mono">
                                            <span>MATCH #{{ $loop->iteration }}</span>
                                            <span>B1</span>
                                        </div>

                                        <!-- Player 1 -->
                                        <div class="px-3.5 py-2.5 flex items-center justify-between border-b border-gray-150 hover:bg-white transition-colors">
                                            <div class="truncate pr-2">
                                                <span class="font-bold text-gray-800 text-xs block truncate">{{ $match->peserta1->name }}</span>
                                                <span class="text-[9px] text-gray-400 block">{{ $match->peserta1->kelas }}</span>
                                            </div>
                                            @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_1_id)
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black">👑</span>
                                            @endif
                                        </div>

                                        <!-- Player 2 -->
                                        <div class="px-3.5 py-2.5 flex items-center justify-between hover:bg-white transition-colors">
                                            @if ($match->peserta2)
                                                <div class="truncate pr-2">
                                                    <span class="font-bold text-gray-800 text-xs block truncate">{{ $match->peserta2->name }}</span>
                                                    <span class="text-[9px] text-gray-400 block">{{ $match->peserta2->kelas }}</span>
                                                </div>
                                                @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_2_id)
                                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black">👑</span>
                                                @endif
                                            @else
                                                <div class="text-left py-1 text-yellow-700">
                                                    <span class="text-[10px] font-black uppercase tracking-wider block">BYE (Lolos)</span>
                                                    <span class="text-[9px] text-yellow-600 block leading-tight">Maju ke semifinal</span>
                                                </div>
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black">👑</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Round 2: Semifinal -->
                    <div class="flex flex-col justify-center space-y-8 w-64">
                        <div class="text-center font-bold text-gray-500 uppercase tracking-wider text-xs border-b border-gray-100 pb-2.5">
                            Babak 2: Semifinal
                        </div>
                        <div class="flex flex-col justify-around h-full space-y-12">
                            @if ($rounds->has(2))
                                @foreach ($rounds->get(2) as $match)
                                    <!-- Dynamic Semifinal Match -->
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                                        <div class="bg-gray-100/80 px-3 py-1.5 border-b border-gray-200 flex justify-between items-center text-[10px] font-bold text-gray-500 font-mono">
                                            <span>MATCH #{{ $loop->iteration }}</span>
                                            <span>B2</span>
                                        </div>
                                        <div class="px-3.5 py-2.5 flex items-center justify-between border-b border-gray-150">
                                            <span class="font-bold text-gray-800 text-xs">{{ $match->peserta1->name }}</span>
                                            @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_1_id)
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black">👑</span>
                                            @endif
                                        </div>
                                        <div class="px-3.5 py-2.5 flex items-center justify-between">
                                            @if ($match->peserta2)
                                                <span class="font-bold text-gray-800 text-xs">{{ $match->peserta2->name }}</span>
                                                @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_2_id)
                                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black">👑</span>
                                                @endif
                                            @else
                                                <span class="text-[10px] font-bold text-gray-400 italic">Menunggu Lawan</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Placeholders for Semifinal -->
                                @php
                                    $semifinalSlots = max(1, ceil($rounds->get(1, collect())->count() / 2));
                                @endphp
                                @for ($s = 0; $s < $semifinalSlots; $s++)
                                    <div class="bg-gray-50/50 border border-dashed border-gray-200 rounded-xl p-4 text-center">
                                        <span class="text-xs text-gray-400 font-bold block">Semifinal Slot #{{ $s+1 }}</span>
                                        <span class="text-[9px] text-gray-400 block mt-1">Belum Terjadwal</span>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>

                    <!-- Round 3: Final -->
                    <div class="flex flex-col justify-center space-y-8 w-64">
                        <div class="text-center font-bold text-gray-500 uppercase tracking-wider text-xs border-b border-gray-100 pb-2.5">
                            Babak 3: Final
                        </div>
                        <div class="flex flex-col justify-center h-full">
                            @if ($rounds->has(3))
                                @foreach ($rounds->get(3) as $match)
                                    <!-- Dynamic Final Match -->
                                    <div class="bg-yellow-50/30 border-2 border-yellow-400/50 rounded-xl overflow-hidden shadow-md">
                                        <div class="bg-yellow-400/10 px-3 py-1.5 border-b border-yellow-400/30 flex justify-between items-center text-[10px] font-bold text-yellow-800 font-mono">
                                            <span>MATCH FINAL</span>
                                            <span>B3</span>
                                        </div>
                                        <div class="px-3.5 py-3 flex items-center justify-between border-b border-yellow-400/20">
                                            <span class="font-extrabold text-gray-900 text-xs">{{ $match->peserta1->name }}</span>
                                            @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_1_id)
                                                <span class="text-xs bg-yellow-400 text-red-950 px-2 py-0.5 rounded font-black">👑 JUARA</span>
                                            @endif
                                        </div>
                                        <div class="px-3.5 py-3 flex items-center justify-between">
                                            @if ($match->peserta2)
                                                <span class="font-extrabold text-gray-900 text-xs">{{ $match->peserta2->name }}</span>
                                                @if ($match->status === 'selesai' && $match->pemenang_id === $match->peserta_2_id)
                                                    <span class="text-xs bg-yellow-400 text-red-950 px-2 py-0.5 rounded font-black">👑 JUARA</span>
                                                @endif
                                            @else
                                                <span class="text-[10px] font-bold text-gray-400 italic">Menunggu Finalis</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Placeholder for Final -->
                                <div class="bg-yellow-50/10 border border-dashed border-yellow-200 rounded-xl p-6 text-center space-y-1">
                                    <span class="text-xl">🏆</span>
                                    <span class="text-xs text-yellow-800 font-black block">Grand Final</span>
                                    <span class="text-[9px] text-gray-400 block">Menunggu Hasil Penyisihan</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="text-center pt-4">
            <a href="/" class="inline-flex items-center px-4 py-2 border border-gray-300 text-xs font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                ← Kembali ke Halaman Utama
            </a>
        </div>

    </div>
</section>
@endsection
