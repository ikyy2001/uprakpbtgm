# 📖 Panduan Penggunaan & Daftar Fitur RuangLomba

Selamat datang di file dokumentasi **RuangLomba**! Dokumen ini menjelaskan seluruh fitur yang tersedia dalam sistem serta panduan lengkap cara menggunakannya baik untuk **Peserta (Siswa)** maupun **Panitia (Admin)**.

---

## 🔑 Akun Bawaan (Default Accounts)
Gunakan akun di bawah ini untuk menguji sistem:

### 1. Akun Panitia (Admin)
- **Email**: `admin@lomba17.com`
- **Password**: `password`

### 2. Akun Peserta (Siswa)
- **Wali/Ketua Kelas**: `adi@pelitanusantara.sch.id` | `siti@pelitanusantara.sch.id` | `budi@pelitanusantara.sch.id`
- **Password**: `password`

---

## 🌟 Fitur Halaman Publik (Landing Page)

### 1. Statistik Kemerdekaan Real-Time
- Menampilkan visual counter yang terhubung langsung ke database:
  - **Cabang Lomba**: Jumlah perlombaan terdaftar.
  - **Kelas Terdaftar**: Jumlah kelas unik peserta.
  - **Peserta Terdaftar**: Jumlah pendaftaran siswa terverifikasi.

### 2. Roster Lomba Dinamis
- Menampilkan kartu-kartu cabang lomba yang terdaftar di database.
- Dilengkapi dengan status **Tersedia** atau **Penuh** berdasarkan kuota maksimal.
- Menunjukkan detail jumlah peserta terdaftar (misal: `12 / 20 Terdaftar`).

### 3. Bagan & Jadwal Pertandingan Terkini
- Menampilkan jadwal pertandingan aktif per babak.
- Menunjukkan detail competitor (nama siswa & kelas), status tanding (**Belum Mulai**, **Berlangsung**, **Selesai**), serta mahkota pemenang (`👑 Pemenang: ...`).
- Dilengkapi dengan kondisi *Bye* otomatis jika jumlah peserta ganjil.

### 4. Papan Skor (Leaderboard) Kelas
- Menampilkan podium top 3 kelas teratas.
- Menampilkan tabel klasemen medali: emas (🥇), perak (🥈), total partisipasi, dan akumulasi poin.
- **Sistem Poin**:
  - Partisipasi lomba: `+10 Poin` per pendaftaran terverifikasi/menunggu.
  - Kemenangan Babak 1: `+50 Poin`.
  - Kemenangan Semifinal: `+75 Poin` & Medali Perak.
  - Kemenangan Final: `+100 Poin` & Medali Emas.

---

## 👤 Fitur Dasbor Peserta (Siswa)

### 1. Formulir Pendaftaran Lomba
- Siswa dapat mendaftarkan diri pada cabang lomba yang diinginkan.
- Pilihan lomba yang sudah diikuti atau yang kuotanya sudah penuh akan dinonaktifkan secara otomatis.
- **Batas Pendaftaran**: Setiap akun peserta dibatasi maksimal hanya boleh mengikuti **2 cabang lomba**.

### 2. Riwayat Pendaftaran
- Menampilkan daftar pendaftaran yang diajukan beserta status verifikasi (**Menunggu**, **Terverifikasi**, atau **Ditolak**).

---

## 🛠️ Fitur Dasbor Panitia (Admin)

### 1. Verifikasi Pendaftaran Masuk
- Panitia dapat menyetujui (**Setujui**) atau menolak (**Tolak**) pengajuan pendaftaran siswa.
- Sistem mencegah persetujuan jika kuota maksimal lomba tersebut telah terpenuhi.

### 2. Pengelolaan Bagan & Matchmaking
- **Generate Bagan**: Mengacak peserta terverifikasi untuk menyusun pertandingan Babak 1 secara otomatis.
- **Bracket Lock**: Tombol *Generate Ulang* otomatis terkunci (**🔒 Bagan Sedang Berjalan / Selesai**) jika ada pertandingan yang statusnya sudah dimulai (*Berlangsung*) atau selesai (*Selesai*).
- **Penginputan Pemenang**: Panitia memilih pemenang di setiap pertandingan melalui dropdown menu. Hasil pemenang akan otomatis memajukan peserta tersebut ke babak berikutnya (*Advance Winner*).

### 3. Diskualifikasi & Kick
- **Dis (Diskualifikasi)**: Mengubah status pendaftaran siswa menjadi *Ditolak* tanpa menghapus data pendaftar. Pertandingan aktifnya otomatis memenangkan lawannya.
- **Kick (Hapus)**: Menghapus data pendaftaran siswa secara permanen dari lomba. Pertandingan aktifnya otomatis memenangkan lawannya.
- **Proteksi Leaderboard**: Skor kemenangan dari siswa yang telah di-kick atau didiskualifikasi secara otomatis dihapus (tidak dihitung) dari poin leaderboard kelas. Kelas dengan 0 pendaftaran aktif akan disembunyikan dari leaderboard.

### 4. Kelola Pengguna (User Management)
- Menampilkan daftar seluruh akun di database.
- Admin dapat menghapus akun peserta/panitia lain secara permanen (**Hapus Akun**).
- Sistem memblokir admin agar tidak menghapus akunnya sendiri.

### 5. Reset Data
- Panel khusus untuk membersihkan data sistem dengan pilihan:
  - **Reset Bagan Pertandingan**: Menghapus seluruh jadwal bagan tanding.
  - **Reset Hasil & Skor Tanding**: Mengosongkan pemenang dan mengembalikan status ke "Belum Mulai" tanpa menghapus struktur bagan.
  - **Reset Pendaftaran Peserta**: Menghapus seluruh data pengajuan pendaftaran beserta bagannya.
  - **Reset Seluruh Data (Semua)**: Menghapus pendaftaran, bagan, dan klasemen skor.
- Dilengkapi dengan checkbox konfirmasi wajib sebelum tombol eksekusi aktif.

---

## 🔒 Kebijakan Keamanan Autentikasi
- **Registrasi Akun Baru Dinonaktifkan**: Pengguna tidak dapat mendaftarkan akun secara mandiri via website. Halaman `/register` akan menampilkan petunjuk untuk menghubungi administrator **SMK PLUS PELITA NUSANTARA** di email `rijal@smkpnb.sch.id`.
- Percobaan registrasi akun via POST request langsung akan diblokir dengan respon **403 Forbidden**.

---

## 🚀 Panduan Menjalankan Aplikasi Secara Lokal
1. Pastikan Anda berada di direktori project.
2. Jalankan server backend Laravel:
   ```bash
   php artisan serve
   ```
3. Jalankan server frontend Vite:
   ```bash
   npm run dev
   ```
4. Buka browser di alamat `http://127.0.0.1:8000`.
