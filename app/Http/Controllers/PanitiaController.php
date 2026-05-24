<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{
    /**
     * Tampilkan Halaman Utama Dasbor Panitia.
     */
    public function dashboard()
    {
        // Hitung statistik
        $stats = [
            'total_pendaftar' => Pendaftaran::count(),
            'pending' => Pendaftaran::where('status', 'menunggu')->count(),
            'terverifikasi' => Pendaftaran::where('status', 'terverifikasi')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        // Ambil data pendaftaran terbaru beserta relasinya
        $registrations = Pendaftaran::with(['user', 'lomba'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil daftar lomba beserta jumlah peserta terverifikasi
        $lombas = Lomba::withCount(['users as jumlah_peserta' => function ($query) {
            $query->where('status', 'terverifikasi');
        }])->get();

        return view('panitia.dashboard', compact('stats', 'registrations', 'lombas'));
    }

    /**
     * Setujui atau tolak pengajuan pendaftaran lomba.
     */
    public function verifikasi(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => ['required', 'in:terverifikasi,ditolak'],
        ]);

        $lomba = Lomba::findOrFail($pendaftaran->lomba_id);

        // Jika disetujui, pastikan kuota lomba belum penuh
        if ($request->status === 'terverifikasi') {
            $verifiedCount = Pendaftaran::where('lomba_id', $pendaftaran->lomba_id)
                ->where('status', 'terverifikasi')
                ->count();

            if ($verifiedCount >= $lomba->batas_kuota_maksimal) {
                return redirect()->back()
                    ->with('error', "Gagal memverifikasi. Kuota peserta untuk lomba \"{$lomba->nama_lomba}\" sudah penuh.");
            }
        }

        $pendaftaran->update([
            'status' => $request->status,
        ]);

        $statusText = $pendaftaran->status === 'terverifikasi' ? 'disetujui' : 'ditolak';

        return redirect()->back()
            ->with('success', "Pendaftaran siswa \"{$pendaftaran->user->name}\" pada lomba \"{$lomba->nama_lomba}\" berhasil {$statusText}.");
    }

    /**
     * Tampilkan detail lomba beserta daftar peserta dan bagan pertandingan.
     */
    public function showLomba(Lomba $lomba)
    {
        // Ambil semua pendaftar untuk lomba ini
        $registrations = Pendaftaran::where('lomba_id', $lomba->id)
            ->with('user')
            ->get();

        // Ambil pertandingan yang sudah dibuat
        $matches = Pertandingan::where('lomba_id', $lomba->id)
            ->with(['peserta1', 'peserta2', 'pemenang'])
            ->orderBy('babak')
            ->get();

        return view('panitia.lomba_show', compact('lomba', 'registrations', 'matches'));
    }

    /**
     * Generate bagan pertandingan acak (babak 1 / penyisihan).
     */
    public function generateBagan(Lomba $lomba)
    {
        // Ambil semua user_id yang status pendaftarannya terverifikasi di lomba ini
        $verifiedUserIds = Pendaftaran::where('lomba_id', $lomba->id)
            ->where('status', 'terverifikasi')
            ->pluck('user_id')
            ->toArray();

        $count = count($verifiedUserIds);

        // Validasi minimal peserta
        if ($count < 2) {
            return redirect()->back()
                ->with('error', 'Gagal generate bagan. Harus terdapat minimal 2 peserta terverifikasi pada cabang lomba ini.');
        }

        // Hapus bagan lama untuk lomba ini
        Pertandingan::where('lomba_id', $lomba->id)->delete();

        // Acak urutan peserta (shuffle)
        shuffle($verifiedUserIds);

        // Lakukan pengundian berpasangan
        for ($i = 0; $i < $count; $i += 2) {
            if (isset($verifiedUserIds[$i + 1])) {
                // Pasangan normal 1 vs 1
                Pertandingan::create([
                    'lomba_id' => $lomba->id,
                    'peserta_1_id' => $verifiedUserIds[$i],
                    'peserta_2_id' => $verifiedUserIds[$i + 1],
                    'babak' => 1,
                    'status' => 'belum_mulai',
                ]);
            } else {
                // Bye condition: jumlah ganjil, peserta langsung menang dan lolos ke babak berikutnya
                Pertandingan::create([
                    'lomba_id' => $lomba->id,
                    'peserta_1_id' => $verifiedUserIds[$i],
                    'peserta_2_id' => null,
                    'pemenang_id' => $verifiedUserIds[$i],
                    'babak' => 1,
                    'status' => 'selesai',
                ]);
            }
        }

        return redirect()->back()
            ->with('success', "Bagan pertandingan babak 1 untuk lomba \"{$lomba->nama_lomba}\" berhasil di-generate secara acak.");
    }

    /**
     * Tentukan pemenang pertandingan dan majukan pemenang ke babak berikutnya.
     */
    public function setWinner(Request $request, Pertandingan $match)
    {
        $request->validate([
            'pemenang_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->pemenang_id != $match->peserta_1_id && $request->pemenang_id != $match->peserta_2_id) {
            return redirect()->back()->with('error', 'Pemenang harus salah satu dari peserta pertandingan.');
        }

        $match->update([
            'pemenang_id' => $request->pemenang_id,
            'status' => 'selesai',
        ]);

        // Majukan pemenang ke babak berikutnya
        $this->advanceWinner($match);

        return redirect()->back()->with('success', 'Hasil pertandingan berhasil diperbarui.');
    }

    /**
     * Logika otomatisasi bagan: memajukan pemenang ke babak berikutnya.
     */
    protected function advanceWinner(Pertandingan $match)
    {
        $lombaId = $match->lomba_id;
        $round = $match->babak;
        $winnerId = $match->pemenang_id;

        // Ambil semua pertandingan di babak saat ini diurutkan berdasarkan ID
        $matchesInRound = Pertandingan::where('lomba_id', $lombaId)
            ->where('babak', $round)
            ->orderBy('id')
            ->get();

        // Cari indeks pertandingan saat ini
        $matchIndex = $matchesInRound->pluck('id')->search($match->id);
        if ($matchIndex === false) {
            return;
        }

        // Tentukan indeks target babak berikutnya
        $targetIndex = (int) floor($matchIndex / 2);
        $nextRound = $round + 1;

        // Cari pertandingan di babak berikutnya
        $targetMatches = Pertandingan::where('lomba_id', $lombaId)
            ->where('babak', $nextRound)
            ->orderBy('id')
            ->get();

        if ($targetMatches->count() > $targetIndex) {
            // Jika pertandingan target sudah di-generate, tinggal pasangkan
            $targetMatch = $targetMatches[$targetIndex];
        } else {
            // Jika belum ada, buat pertandingan baru
            $targetMatch = Pertandingan::create([
                'lomba_id' => $lombaId,
                'peserta_1_id' => $winnerId, // Letakkan sebagai peserta 1 sementara waktu
                'peserta_2_id' => null,
                'babak' => $nextRound,
                'status' => 'belum_mulai',
            ]);
            return;
        }

        // Tentukan apakah masuk ke slot peserta 1 atau peserta 2
        if ($matchIndex % 2 === 0) {
            $targetMatch->peserta_1_id = $winnerId;
        } else {
            $targetMatch->peserta_2_id = $winnerId;
        }

        $targetMatch->save();
    }

    /**
     * Otoritas Panitia: Diskualifikasi peserta dari lomba.
     */
    public function diskualifikasi(Request $request, Lomba $lomba, \App\Models\User $user)
    {
        // Ubah status pendaftaran menjadi ditolak
        $pendaftaran = Pendaftaran::where('lomba_id', $lomba->id)
            ->where('user_id', $user->id)
            ->first();

        if ($pendaftaran) {
            $pendaftaran->update(['status' => 'ditolak']);
        }

        // Cari pertandingan aktif (belum selesai) yang diikuti oleh peserta tersebut
        $activeMatches = Pertandingan::where('lomba_id', $lomba->id)
            ->where('status', '!=', 'selesai')
            ->where(function ($query) use ($user) {
                $query->where('peserta_1_id', $user->id)
                      ->orWhere('peserta_2_id', $user->id);
            })
            ->get();

        foreach ($activeMatches as $match) {
            // Tentukan lawan tandingnya
            $opponentId = ($match->peserta_1_id == $user->id) ? $match->peserta_2_id : $match->peserta_1_id;

            if ($opponentId) {
                // Jika ada lawan, maka lawan tersebut otomatis menang
                $match->update([
                    'pemenang_id' => $opponentId,
                    'status' => 'selesai',
                ]);
                $this->advanceWinner($match);
            } else {
                // Jika tidak ada lawan (misalnya bye), cukup selesaikan pertandingan
                $match->update(['status' => 'selesai']);
            }
        }

        return redirect()->back()
            ->with('success', "Siswa \"{$user->name}\" berhasil didiskualifikasi dari lomba \"{$lomba->nama_lomba}\". Pertandingan aktifnya otomatis memenangkan lawan.");
    }
}
