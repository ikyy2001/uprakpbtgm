# RuangLomba - Pendaftaran Lomba 17-an Pelita Nusantara

RuangLomba adalah aplikasi monolitik berbasis web yang dirancang untuk mengelola pendaftaran dan visualisasi bagan pertandingan turnamen 17 Agustus secara digital di SMK Plus Pelita Nusantara.

---

## 🛠️ Teknologi & Stack Utama

- **Framework**: Laravel 11 (PHP)
- **Frontend**: Blade Templating Engine
- **Styling**: Tailwind CSS (melalui integrasi Vite)
- **Database**: MySQL
- **Autentikasi**: Laravel Breeze (Blade Stack)

---

## 🚀 Panduan Instalasi & Penggunaan

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di lingkungan lokal Anda:

### 1. Prasyarat Sistem
Pastikan Anda sudah menginstal:
- PHP >= 8.2 (dengan ekstensi PDO MySQL teraktifkan)
- Composer
- Node.js & NPM
- MySQL Server

### 2. Instalasi Dependensi
Jalankan perintah berikut di terminal repositori Anda untuk menginstal semua library PHP dan Node.js:
```bash
# Instal dependensi PHP
composer install

# Instal dependensi Javascript/CSS
npm install
```

### 3. Konfigurasi Database (`.env`)
Salin file `.env.example` menjadi `.env` jika belum ada:
```bash
copy .env.example .env
```
Sesuaikan pengaturan database pada file `.env` Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pendaftaran_lomba
DB_USERNAME=root
DB_PASSWORD=
```
*Catatan: Pastikan database bernama `pendaftaran_lomba` sudah dibuat di MySQL server Anda.*

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Migrasi & Seeding Data Awal
Jalankan migrasi untuk membuat tabel, sekaligus jalankan *seeder* untuk mengisi data akun panitia, akun siswa, dan cabang lomba awal:
```bash
php artisan migrate:fresh --seed
```

### 6. Kompilasi Aset Frontend (Vite)
Jalankan server pengembangan Vite untuk rendering gaya Tailwind CSS secara real-time:
```bash
npm run dev
```
Atau jika ingin melakukan kompilasi versi produksi yang teroptimasi:
```bash
npm run build
```

### 7. Jalankan Server Lokal Laravel
Jalankan server PHP lokal untuk mengakses aplikasi:
```bash
php artisan serve
```
Buka peramban (browser) Anda dan akses alamat: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**.

---

## 📌 Alur Fitur Utama & Cara Penggunaan

### 1. Beranda Publik & Papan Skor (Leaderboard)
- **Halaman Utama (`/`)**: Desain meriah merah-putih berisi informasi umum lomba, galeri statis kemerdekaan, syarat, dan tombol registrasi kelas.
- **Papan Skor (`/leaderboard`)**: Klasemen kumulatif poin kelas yang dihitung secara real-time berdasarkan hasil perlombaan. Setiap pendaftaran terverifikasi bernilai `+10` poin, kemenangan Babak Penyisihan bernilai `+50` poin, Semifinal bernilai `+75` poin, dan Juara 1 bernilai `+100` poin.

### 2. Dashboard Peserta (Siswa / Perwakilan Kelas)
- Akses halaman login/register di kanan atas.
- Siswa dapat memilih cabang lomba yang tersedia secara dinamis dan mendaftar (maksimal batas partisipasi: 2 lomba per siswa).
- Status pendaftaran (Menunggu / Terverifikasi / Ditolak) dapat dipantau langsung dari tabel riwayat di dasbor peserta.

### 3. Panel Panitia
- Panitia dapat memverifikasi pengajuan pendaftaran siswa (dengan validasi batas kuota maksimal per lomba).
- Setelah peserta terverifikasi minimal 2 orang, panitia dapat menekan tombol **"Generate Bagan"** untuk membuat bagan pertandingan acak secara otomatis. Jika jumlah peserta ganjil, sistem otomatis menghasilkan slot *Bye* (meloloskan satu peserta langsung ke babak berikutnya).
- Panitia dapat menginput pemenang pertandingan selesai. Sistem akan otomatis memindahkan pemenang ke slot babak berikutnya di bagan tanding.
- Panitia memiliki wewenang untuk melakukan **Diskualifikasi** siswa yang melanggar. Siswa yang didiskualifikasi akan dikeluarkan, pendaftarannya dibatalkan, dan pertandingan aktifnya otomatis memenangkan lawan.

---

## 🧪 Menjalankan Unit & Feature Testing

Aplikasi ini dilengkapi dengan suite pengujian otomatis lengkap (40 test cases) untuk memastikan fungsionalitas registrasi, bagan acak, advancement bracket, disqualifikasi, dan poin leaderboard aman.
Jalankan perintah ini:
```bash
php artisan test
```
