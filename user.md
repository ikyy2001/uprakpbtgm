# Data Akun Pengguna untuk Uji Coba (Credentials)

Semua akun di bawah ini telah di-generate secara otomatis melalui database seeder (`DatabaseSeeder.php`). Gunakan data berikut untuk masuk (login) ke dalam sistem RuangLomba.

---

## 🔑 Akun Panitia (Committee Account)

Akun ini memiliki wewenang penuh untuk memverifikasi pendaftaran, melakukan pengundian bagan tanding, memasukkan hasil skor pemenang pertandingan, serta mendiskualifikasi peserta.

- **Role**: Panitia (Committee)
- **Nama**: Panitia Utama
- **Email**: `admin@lomba17.com`
- **Password**: `password`
rijal@smkpnb.sch.id

---

## 👥 Akun Peserta / Murid (Student/Participant Accounts)

Akun-akun di bawah ini mewakili siswa perwakilan kelas yang mendaftar ke berbagai cabang lomba 17-an. Setiap akun memiliki batas pendaftaran maksimal mengikuti 2 cabang lomba.

- **Password Default Semua Akun**: `password`

| No | Nama Siswa | Email | Nomor Induk (NIS) | Kelas | Role |
|:---|:---|:---|:---|:---|:---|
| 1 | **Adi Hidayat** | `adi@pelitanusantara.sch.id` | 202600101 | XII RPL 1 | Peserta |
| 2 | **Siti Rahma** | `siti@pelitanusantara.sch.id` | 202600102 | XI TKJ 2 | Peserta |
| 3 | **Budi Santoso** | `budi@pelitanusantara.sch.id` | 202600103 | X DKV 1 | Peserta |
| 4 | **Citra Lestari** | `citra@pelitanusantara.sch.id` | 202600104 | XII RPL 2 | Peserta |
| 5 | **Dimas Saputra** | `dimas@pelitanusantara.sch.id` | 202600105 | XI TKJ 1 | Peserta |

---

## ⚙️ Cara Uji Coba Cepat (Quick Test Instructions)

1. **Langkah 1**: Masuk sebagai **Panitia** (`admin@lomba17.com`).
2. **Langkah 2**: Pada Dasbor Panitia, Anda akan melihat pengajuan pendaftaran baru yang berstatus "Menunggu". Setujui (*Approve*) seluruh pendaftaran siswa agar mereka terverifikasi.
3. **Langkah 3**: Buka detail cabang lomba (misal: *Balap Karung Helm*), klik tombol **"Generate Bagan Pertandingan"** untuk mengacak tanding para siswa.
4. **Langkah 4**: Simulasikan pertandingan dengan menentukan pemenang di dropdown hasil pertandingan lalu simpan.
5. **Langkah 5**: Kunjungi halaman publik **Papan Skor (Leaderboard)** di navbar untuk melihat akumulasi skor masing-masing kelas terupdate secara dinamis!
