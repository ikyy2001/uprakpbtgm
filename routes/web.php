<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $lombas = \App\Models\Lomba::withCount(['users as jumlah_peserta' => function ($query) {
        $query->where('pendaftarans.status', 'terverifikasi');
    }])->get();

    $matches = \App\Models\Pertandingan::with(['peserta1', 'peserta2', 'pemenang', 'lomba'])
        ->orderBy('babak')
        ->get();

    $panitias = \App\Models\User::where('role', 'panitia')->get();

    $stats = [
        'lomba_count' => \App\Models\Lomba::count(),
        'kelas_count' => \App\Models\User::where('role', 'peserta')->whereNotNull('kelas')->distinct('kelas')->count('kelas'),
        'pendaftar_count' => \App\Models\Pendaftaran::where('status', 'terverifikasi')->count(),
    ];

    return view('welcome', compact('lombas', 'matches', 'panitias', 'stats'));
});


Route::get('/dashboard', function () {
    if (auth()->user()->role === 'panitia') {
        return redirect()->route('panitia.dashboard');
    }
    return redirect()->route('peserta.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:panitia'])->group(function () {
    Route::get('/panitia/dashboard', [\App\Http\Controllers\PanitiaController::class, 'dashboard'])->name('panitia.dashboard');
    Route::post('/panitia/pendaftaran/{pendaftaran}/verifikasi', [\App\Http\Controllers\PanitiaController::class, 'verifikasi'])->name('panitia.pendaftaran.verifikasi');
    Route::get('/panitia/lomba/{lomba}', [\App\Http\Controllers\PanitiaController::class, 'showLomba'])->name('panitia.lomba.show');
    Route::post('/panitia/lomba/{lomba}/generate-bagan', [\App\Http\Controllers\PanitiaController::class, 'generateBagan'])->name('panitia.lomba.generate-bagan');
    Route::post('/panitia/pertandingan/{match}/set-winner', [\App\Http\Controllers\PanitiaController::class, 'setWinner'])->name('panitia.pertandingan.set-winner');
    Route::post('/panitia/lomba/{lomba}/diskualifikasi/{user}', [\App\Http\Controllers\PanitiaController::class, 'diskualifikasi'])->name('panitia.lomba.diskualifikasi');
    Route::post('/panitia/lomba/{lomba}/kick/{user}', [\App\Http\Controllers\PanitiaController::class, 'kick'])->name('panitia.lomba.kick');
    Route::get('/panitia/users', [\App\Http\Controllers\PanitiaController::class, 'usersIndex'])->name('panitia.users.index');
    Route::delete('/panitia/users/{user}', [\App\Http\Controllers\PanitiaController::class, 'usersDelete'])->name('panitia.users.delete');
    Route::get('/panitia/reset', [\App\Http\Controllers\PanitiaController::class, 'showResetForm'])->name('panitia.reset.index');
    Route::post('/panitia/reset', [\App\Http\Controllers\PanitiaController::class, 'processReset'])->name('panitia.reset.process');
});

Route::get('/lomba/{lomba}/bagan', [\App\Http\Controllers\PendaftaranController::class, 'showBagan'])->name('lomba.bagan');
Route::get('/leaderboard', [\App\Http\Controllers\PendaftaranController::class, 'leaderboard'])->name('leaderboard');

Route::middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/peserta/dashboard', [\App\Http\Controllers\PendaftaranController::class, 'dashboard'])->name('peserta.dashboard');
    Route::post('/peserta/daftar', [\App\Http\Controllers\PendaftaranController::class, 'store'])->name('peserta.daftar');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
