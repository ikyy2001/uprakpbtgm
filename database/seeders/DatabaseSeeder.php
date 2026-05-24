<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Panitia Utama
        \App\Models\User::factory()->panitia()->create([
            'name' => 'Panitia Utama',
            'email' => 'admin@lomba17.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // 2. 5 Akun Peserta (Siswa SMK Plus Pelita Nusantara)
        $students = [
            [
                'name' => 'Adi Hidayat',
                'email' => 'adi@pelitanusantara.sch.id',
                'nomor_induk' => '202600101',
                'kelas' => 'XII RPL 1',
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti@pelitanusantara.sch.id',
                'nomor_induk' => '202600102',
                'kelas' => 'XI TKJ 2',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@pelitanusantara.sch.id',
                'nomor_induk' => '202600103',
                'kelas' => 'X DKV 1',
            ],
            [
                'name' => 'Citra Lestari',
                'email' => 'citra@pelitanusantara.sch.id',
                'nomor_induk' => '202600104',
                'kelas' => 'XII RPL 2',
            ],
            [
                'name' => 'Dimas Saputra',
                'email' => 'dimas@pelitanusantara.sch.id',
                'nomor_induk' => '202600105',
                'kelas' => 'XI TKJ 1',
            ],
        ];

        foreach ($students as $student) {
            \App\Models\User::factory()->create(array_merge($student, [
                'role' => 'peserta',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]));
        }

        // 3. 3 Jenis Perlombaan
        $lombas = [
            [
                'nama_lomba' => 'Balap Karung Helm',
                'deskripsi' => 'Lomba balap karung legendaris menggunakan karung goni tebal dan helm keselamatan untuk meminimalisir cedera.',
                'batas_kuota_maksimal' => 20,
            ],
            [
                'nama_lomba' => 'Makan Kerupuk Gantung',
                'deskripsi' => 'Lomba makan kerupuk putih yang digantung pada seutas tali rafia dengan mata tertutup dan kaki diikat.',
                'batas_kuota_maksimal' => 15,
            ],
            [
                'nama_lomba' => 'Turnamen Catur Cepat',
                'deskripsi' => 'Turnamen catur dengan sistem gugur menggunakan batas waktu 10 menit untuk masing-masing pemain.',
                'batas_kuota_maksimal' => 8,
            ],
        ];

        foreach ($lombas as $lomba) {
            \App\Models\Lomba::create($lomba);
        }
    }
}
