<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan Halaman Dasbor Peserta dengan daftar lomba dan riwayat pendaftaran.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Ambil semua lomba beserta hitungan jumlah pendaftarnya
        $lombas = Lomba::withCount(['users as jumlah_pendaftar' => function ($query) {
            $query->whereIn('status', ['terverifikasi', 'menunggu']);
        }])->get();

        // Ambil riwayat pendaftaran user saat ini
        $myRegistrations = Pendaftaran::where('user_id', $user->id)
            ->with('lomba')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peserta.dashboard', compact('lombas', 'myRegistrations'));
    }

    /**
     * Tangani pendaftaran lomba dari formulir peserta.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input Dasar
        $request->validate([
            'lomba_id' => ['required', 'exists:lombas,id'],
        ], [
            'lomba_id.required' => 'Silakan pilih cabang lomba terlebih dahulu.',
            'lomba_id.exists' => 'Cabang lomba yang Anda pilih tidak valid.',
        ]);

        $lombaId = $request->lomba_id;
        $lomba = Lomba::findOrFail($lombaId);

        // 2. Cegah Pendaftaran Ganda (User sudah daftar di lomba ini sebelumnya)
        $isAlreadyRegistered = Pendaftaran::where('user_id', $user->id)
            ->where('lomba_id', $lombaId)
            ->exists();

        if ($isAlreadyRegistered) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Anda sudah terdaftar di cabang lomba \"{$lomba->nama_lomba}\" sebelumnya.");
        }

        // 3. Batasi Jumlah Lomba yang Diikuti Peserta (Maksimal 2 Lomba)
        $myRegistrationCount = Pendaftaran::where('user_id', $user->id)
            ->whereIn('status', ['terverifikasi', 'menunggu'])
            ->count();

        if ($myRegistrationCount >= 2) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Pendaftaran gagal. Anda telah mencapai batas maksimal partisipasi (maksimal hanya boleh mengikuti 2 cabang lomba).');
        }

        // 4. Cek Kuota Lomba (Apakah sudah penuh?)
        $registeredCount = Pendaftaran::where('lomba_id', $lombaId)
            ->whereIn('status', ['terverifikasi', 'menunggu'])
            ->count();

        if ($registeredCount >= $lomba->batas_kuota_maksimal) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Pendaftaran gagal. Kuota peserta untuk lomba \"{$lomba->nama_lomba}\" sudah penuh.");
        }

        // 5. Simpan Data Pendaftaran (Status default: menunggu)
        Pendaftaran::create([
            'user_id' => $user->id,
            'lomba_id' => $lombaId,
            'status' => 'menunggu',
        ]);

        return redirect()->route('peserta.dashboard')
            ->with('success', "Pendaftaran Anda pada cabang lomba \"{$lomba->nama_lomba}\" berhasil dikirim dan sedang menunggu verifikasi panitia.");
    }

    /**
     * Tampilkan visualisasi bagan turnamen secara publik.
     */
    public function showBagan(Lomba $lomba)
    {
        $matches = \App\Models\Pertandingan::where('lomba_id', $lomba->id)
            ->with(['peserta1', 'peserta2', 'pemenang'])
            ->orderBy('babak')
            ->get();

        // Group matches by round (babak)
        $rounds = $matches->groupBy('babak');

        return view('lomba.bagan', compact('lomba', 'rounds'));
    }

    /**
     * Tampilkan Halaman Papan Skor (Leaderboard) Kelas.
     */
    public function leaderboard()
    {
        // Ambil semua pendaftaran terdaftar (aktif)
        $registrations = Pendaftaran::whereIn('status', ['terverifikasi', 'menunggu'])
            ->with('user')
            ->get();

        // Ambil semua pertandingan selesai yang memiliki pemenang
        $matches = \App\Models\Pertandingan::where('status', 'selesai')
            ->whereNotNull('pemenang_id')
            ->get();

        $classPoints = [];

        // 1. Akumulasi Poin Partisipasi (10 Poin per Pendaftaran)
        foreach ($registrations as $reg) {
            $class = $reg->user->kelas;
            if ($class) {
                if (!isset($classPoints[$class])) {
                    $classPoints[$class] = [
                        'class_name' => $class,
                        'points' => 0,
                        'gold' => 0,
                        'silver' => 0,
                        'registrations_count' => 0,
                    ];
                }
                $classPoints[$class]['points'] += 10;
                $classPoints[$class]['registrations_count'] += 1;
            }
        }

        // 2. Akumulasi Poin Kemenangan Pertandingan
        foreach ($matches as $match) {
            $winner = \App\Models\User::find($match->pemenang_id);
            if (!$winner || !$winner->kelas) {
                continue;
            }

            $class = $winner->kelas;
            if (!isset($classPoints[$class])) {
                $classPoints[$class] = [
                    'class_name' => $class,
                    'points' => 0,
                    'gold' => 0,
                    'silver' => 0,
                    'registrations_count' => 0,
                ];
            }

            // Poin berdasarkan babak yang dimenangkan
            if ($match->babak === 1) {
                // Menang babak 1 -> +50 Poin
                $classPoints[$class]['points'] += 50;
            } elseif ($match->babak === 2) {
                // Menang Semifinal (masuk Final) -> +75 Poin
                $classPoints[$class]['points'] += 75;
                $classPoints[$class]['silver'] += 1;
            } elseif ($match->babak === 3) {
                // Menang Final (Juara 1) -> +100 Poin
                $classPoints[$class]['points'] += 100;
                $classPoints[$class]['gold'] += 1;
                // Kurangi silver karena sekarang jadi Gold
                if ($classPoints[$class]['silver'] > 0) {
                    $classPoints[$class]['silver'] -= 1;
                }
            }
        }

        // Urutkan berdasarkan total poin terbesar
        $leaderboard = collect($classPoints)->sortByDesc(function ($item) {
            return [
                $item['points'],
                $item['gold'],
                $item['silver'],
                $item['registrations_count']
            ];
        })->values();

        return view('leaderboard', compact('leaderboard'));
    }
}
