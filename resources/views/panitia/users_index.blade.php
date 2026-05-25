<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Breadcrumbs -->
            <div>
                <a href="{{ route('panitia.dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors flex items-center">
                    ← Kembali ke Dasbor Utama
                </a>
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

            <!-- Users Roster Card -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Daftar Pengguna Terdaftar</h3>
                    <p class="text-xs text-gray-500 mt-1">Daftar seluruh akun panitia dan peserta (siswa) di sistem RuangLomba.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider w-16">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Pengguna</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor Induk / NISN</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kelas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Hak Akses / Role</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-400 font-mono">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <span class="h-8 w-8 rounded-full bg-red-50 text-[#D32F2F] font-black flex items-center justify-center text-xs shadow-inner">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </span>
                                            <span class="font-bold text-gray-900">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-medium">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-mono">{{ $user->nomor_induk ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-bold">{{ $user->kelas ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->role === 'panitia')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-150">
                                                Panitia
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-150">
                                                Siswa / Peserta
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($user->id === auth()->id())
                                            <span class="text-xs text-gray-400 italic">Akun Anda</span>
                                        @else
                                            <form method="POST" action="{{ route('panitia.users.delete', $user->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen dari sistem?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-sm active:scale-95 transition-all cursor-pointer">
                                                    Hapus Akun
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
