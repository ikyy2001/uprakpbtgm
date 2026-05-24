@extends('layouts.landing')

@section('title', 'Papan Skor Kemerdekaan (Leaderboard) - RuangLomba')

@section('content')
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#D32F2F] text-white">
                📈 LIVE UPDATE STANDINGS
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight leading-none">
                Papan Skor Kelas <br>
                <span class="text-[#D32F2F]">SMK Plus Pelita Nusantara</span>
            </h1>
            <p class="text-sm sm:text-base text-gray-500 leading-relaxed max-w-xl mx-auto">
                Persaingan medali dan poin kemerdekaan antar kelas. Dapatkan poin dari pendaftaran partisipasi (+10) dan kemenangan pertandingan.
            </p>
            <div class="w-20 h-1 bg-yellow-400 mx-auto rounded-full mt-2"></div>
        </div>

        @if ($leaderboard->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl border border-gray-150 py-16 px-6 text-center max-w-xl mx-auto space-y-4 shadow-sm">
                <span class="text-5xl block">📈</span>
                <h3 class="text-lg font-bold text-gray-800">Belum Ada Skor Tercatat</h3>
                <p class="text-xs text-gray-500 leading-relaxed max-w-sm mx-auto">
                    Pertandingan belum dimulai atau belum ada hasil pertandingan yang selesai diproses oleh panitia.
                </p>
            </div>
        @else
            <!-- Podium 3 Besar (Only shown if at least 1 class has points) -->
            <div class="flex flex-col sm:flex-row items-end justify-center gap-6 sm:gap-4 max-w-3xl mx-auto pt-8 pb-4">
                
                <!-- Rank 2 (Silver) -->
                @if ($leaderboard->count() > 1)
                    @php $silver = $leaderboard->get(1); @endphp
                    <div class="w-full sm:w-1/3 flex flex-col items-center order-2 sm:order-1">
                        <div class="mb-2.5 text-center">
                            <span class="text-3xl">🥈</span>
                            <h4 class="font-extrabold text-gray-800 text-sm mt-1">{{ $silver['class_name'] }}</h4>
                            <span class="text-xs font-bold text-gray-400">{{ $silver['points'] }} Poin</span>
                        </div>
                        <div class="w-full bg-white border-2 border-gray-200 rounded-t-2xl shadow-md h-32 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-x-0 bottom-0 h-1.5 bg-gray-300"></div>
                            <span class="text-5xl font-black text-gray-200/90 font-mono select-none">2</span>
                        </div>
                    </div>
                @endif

                <!-- Rank 1 (Gold) -->
                @if ($leaderboard->count() > 0)
                    @php $gold = $leaderboard->get(0); @endphp
                    <div class="w-full sm:w-1/3 flex flex-col items-center order-1 sm:order-2">
                        <div class="mb-2.5 text-center">
                            <span class="text-4xl animate-bounce block">👑</span>
                            <span class="text-4xl -mt-2 block">🥇</span>
                            <h4 class="font-black text-gray-900 text-base mt-1">{{ $gold['class_name'] }}</h4>
                            <span class="text-xs font-extrabold text-[#D32F2F]">{{ $gold['points'] }} Poin</span>
                        </div>
                        <div class="w-full bg-white border-2 border-yellow-400 rounded-t-2xl shadow-xl h-44 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-x-0 bottom-0 h-1.5 bg-yellow-400"></div>
                            <span class="text-6xl font-black text-yellow-300/80 font-mono select-none">1</span>
                        </div>
                    </div>
                @endif

                <!-- Rank 3 (Bronze) -->
                @if ($leaderboard->count() > 2)
                    @php $bronze = $leaderboard->get(2); @endphp
                    <div class="w-full sm:w-1/3 flex flex-col items-center order-3 sm:order-3">
                        <div class="mb-2.5 text-center">
                            <span class="text-3xl">🥉</span>
                            <h4 class="font-extrabold text-gray-800 text-sm mt-1">{{ $bronze['class_name'] }}</h4>
                            <span class="text-xs font-bold text-gray-400">{{ $bronze['points'] }} Poin</span>
                        </div>
                        <div class="w-full bg-white border-2 border-gray-200 rounded-t-2xl shadow-md h-24 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-x-0 bottom-0 h-1.5 bg-orange-400/80"></div>
                            <span class="text-4xl font-black text-gray-200/90 font-mono select-none">3</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Table Standings -->
            <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm max-w-4xl mx-auto">
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Klasemen Perolehan Poin</h3>
                    <p class="text-xs text-gray-500 mt-1">Daftar peringkat kelas SMK Plus Pelita Nusantara selengkapnya.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-16">Peringkat</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Kelas</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Partisipasi</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Emas (🥇)</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Perak (🥈)</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Total Poin</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm">
                            @foreach ($leaderboard as $index => $item)
                                <tr class="hover:bg-gray-50/50 transition-colors @if($index === 0) bg-yellow-50/10 @endif">
                                    <!-- Rank Number -->
                                    <td class="px-6 py-4 whitespace-nowrap font-black text-gray-400 text-center font-mono">
                                        @if ($index === 0)
                                            <span class="text-yellow-600 font-bold bg-yellow-50 px-2 py-0.5 rounded border border-yellow-250">#1</span>
                                        @elseif ($index === 1)
                                            <span class="text-gray-600 font-bold bg-gray-50 px-2 py-0.5 rounded border border-gray-250">#2</span>
                                        @elseif ($index === 2)
                                            <span class="text-orange-800 font-bold bg-orange-50 px-2 py-0.5 rounded border border-orange-250">#3</span>
                                        @else
                                            #{{ $index + 1 }}
                                        @endif
                                    </td>
                                    
                                    <!-- Class Name -->
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                        {{ $item['class_name'] }}
                                    </td>
                                    
                                    <!-- Participations -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">
                                        {{ $item['registrations_count'] }} Lomba
                                    </td>
                                    
                                    <!-- Gold Medals -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-yellow-600">
                                        {{ $item['gold'] }}
                                    </td>
                                    
                                    <!-- Silver Medals -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-gray-500">
                                        {{ $item['silver'] }}
                                    </td>
                                    
                                    <!-- Total Points -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-black text-lg text-gray-800">
                                        {{ $item['points'] }} <span class="text-[10px] font-bold text-gray-400">PTS</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
