# 📚 Digital Library - Sistem Informasi Perpustakaan Digital

Repositori ini berisi *source code* untuk Tugas Terstruktur Pemrograman Web: **Pengembangan Sistem Informasi Perpustakaan Digital**. Aplikasi ini dibangun menggunakan PHP Native, MySQL, dan UI Framework Bootstrap 5 dengan antarmuka yang elegan dan responsif.

## 👨‍💻 Identitas Mahasiswa

* **Nama:** BAEDO HADI PERWIRA ACHMAD

* **NPM / NIM:** 2513020033

* **Program Studi:** SISTEM INFORMASI

* **Mata Kuliah:** Pemrograman Web

## 🎥 Video Demo Aplikasi

\[Masukkan Link YouTube Demo Aplikasi Anda di Sini\]

## ⚙️ Fitur Utama Aplikasi

Sistem ini dirancang dengan desain modern (Simple & Elegant) serta memenuhi seluruh kriteria logika bisnis yang dipersyaratkan:

1. **Autentikasi & Hak Akses (Role-Based Access Control):**

   * **Admin:** Memiliki akses penuh untuk mengelola data buku (Create, Read, Update, Delete) serta dapat menambahkan *user* baru.

   * **User:** Hanya memiliki akses untuk melihat daftar buku dan fitur **Pinjam** (mengurangi stok secara otomatis).

   * **Session & Cookie:** Dilengkapi fitur *Remember Me* untuk menyimpan identitas *username* pada *browser* secara aman selama 30 hari.

2. **Pengelolaan Data Buku (CRUD):**

   * **Create:** Tambah data buku beserta form *upload* gambar sampul.

   * **Read:** Menampilkan daftar koleksi buku dalam bentuk tabel interaktif (*hover effects*).

   * **Update:** Mengubah informasi data buku dan opsi memperbarui file sampul (sistem akan otomatis menghapus/ *unlink* file sampul lama dari server).

   * **Delete:** Menghapus data dari MySQL sekaligus membersihkan berkas gambar terkait di folder server.

3. **Manajemen Berkas (Upload File):**

   * Validasi tipe/ekstensi file (`.jpg`, `.jpeg`, `.png`).

   * Validasi ukuran berkas maksimal **2MB**.

4. **Logika Bisnis & Ketersediaan:**

   * Sistem otomatis memvalidasi status ketersediaan berdasarkan stok (*if-else*):

     * Stok $> 0$ $\rightarrow$ **Tersedia**

     * Stok $= 0$ $\rightarrow$ **Dipinjam**

   * Jika user meminjam buku, stok akan berkurang 1. Jika stok habis, tombol pinjam akan nonaktif (disabled).

## 🗄️ Struktur Tabel Database (`db_perpustakaan`)

File *dump* database tersedia dalam proyek dengan nama file `db_perpustakaan.sql`.

### 1. Tabel `users`

Digunakan untuk manajemen hak akses sistem.

| Nama Kolom | Tipe Data | Keterangan | 
| ----- | ----- | ----- | 
| `id` | `INT(11)` | Primary Key, Auto Increment | 
| `username` | `VARCHAR(50)` | Username pengguna | 
| `password` | `VARCHAR(255)` | Password tersimpan (di-hash MD5) | 
| `role` | `ENUM('admin','user')` | Level hak akses pengguna sistem | 

### 2. Tabel `buku`

Digunakan untuk menyimpan informasi master data buku.

| Nama Kolom | Tipe Data | Keterangan | 
| ----- | ----- | ----- | 
| `id` | `INT(11)` | Primary Key, Auto Increment | 
| `judul` | `VARCHAR(150)` | Judul buku | 
| `kategori` | `VARCHAR(100)` | Kategori koleksi | 
| `penulis` | `VARCHAR(150)` | Nama penulis | 
| `tahun_terbit` | `INT(4)` | Tahun terbit buku | 
| `stok` | `INT(11)` | Jumlah stok tersedia | 
| `status_ketersediaan` | `VARCHAR(50)` | Status ("Tersedia" atau "Dipinjam") | 
| `sampul` | `VARCHAR(255)` | Nama file gambar fisik di folder `/uploads` | 

## 📂 Struktur Direktori Proyek

```
project_perpustakaan/
├── assets/
│   └── css/style.css     # File custom CSS untuk styling elegan
├── config/
│   └── koneksi.php       # Konfigurasi koneksi database MySQL
├── uploads/              # Folder penampung file gambar sampul
├── index.php             # Halaman Login & Form Cookie "Remember Me"
├── proses_login.php      # Verifikasi autentikasi (Session & Cookie)
├── dashboard.php         # Halaman Utama (Read Data & Navigasi)
├── tambah_buku.php       # Form Input Tambah Data Buku (Khusus Admin)
├── proses_tambah.php     # Query Insert & Operasi Upload File
├── edit_buku.php         # Form Edit Data Buku (Khusus Admin)
├── proses_edit.php       # Query Update & Penggantian File Gambar
├── hapus_buku.php        # Query Delete & Unlink File (Khusus Admin)
├── pinjam_buku.php       # Logika pengurangan stok (Khusus User)
├── tambah_user.php       # Form Tambah Pengguna Baru (Khusus Admin)
├── proses_tambah_user.php# Query Insert User Baru
├── logout.php            # Hapus Session & Cookie
└── db_perpustakaan.sql   # File ekspor database MySQL

```

## 🚀 Panduan Instalasi Lokal

1. Salin seluruh folder aplikasi ke dalam direktori server lokal Anda (contoh: `C:/xampp/htdocs/`).

2. Buka **XAMPP Control Panel**, lalu jalankan service **Apache** dan **MySQL**.

3. Buka browser dan kunjungi `http://localhost/phpmyadmin`.

4. Buat database baru dengan nama `db_perpustakaan`.

5. Impor (*Import*) file `db_perpustakaan.sql` ke dalam database tersebut.

6. Akses aplikasi melalui URL browser Anda.

### 🔑 Akun Default Login:

* **Akses Admin:**

  * Username: `admin`

  * Password: `admin123`

* **Akses User (Peminjam):**

  * Username: `user`

  * Password: `user123`

## 📸 Screenshot Tampilan Aplikasi

*(Untuk menambahkan screenshot di GitHub: drag & drop gambar screenshot Anda langsung ke dalam editor file README.md ini saat mengedit di GitHub)*

### 1. Halaman Login

<img width="1366" height="768" alt="Screenshot 2026-11-04 005356" src="https://github.com/user-attachments/assets/975030a6-ba8f-4df8-9bbd-2ff111013cf4" />

### 2. Dashboard - Akses Admin (Full CRUD & Manajemen User)

<img width="1366" height="768" alt="Screenshot 2026-11-04 013614" src="https://github.com/user-attachments/assets/fc5eaca1-0b28-4cf5-846b-babb5fba6691" />

### 3. Dashboard - Akses User (Fitur Pinjam Buku)

<img width="1366" height="768" alt="Screenshot 2026-11-04 013744" src="https://github.com/user-attachments/assets/8b5f8522-df84-41f5-8331-0181dd2f32a0" />

### 4. Form Tambah User (Desain Elegan)

<img width="1366" height="768" alt="Screenshot 2026-11-04 010246" src="https://github.com/user-attachments/assets/5676ac52-000a-4bbd-bbe6-fab55b58f9bc" />

### 5. Form Tambah Buku (Desain Elegan)

<img width="1366" height="768" alt="Screenshot 2026-11-04 010323" src="https://github.com/user-attachments/assets/e10f240d-5962-47ec-b05f-bfa593bdbc9d" />

*Dibuat untuk memenuhi Tugas Terstruktur Mata Kuliah Pemrograman Web.*
