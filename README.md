# 📘 DOKUMENTASI SISTEM: GERD CARE

Sistem Skrining Penyakit GERD Berbasis Web (MVC PHP Native) Fakultas Kesehatan Masyarakat - Universitas Muslim Indonesia

---

## 📑 DAFTAR ISI

1. Deskripsi Sistem
2. Arsitektur & Teknologi
3. Desain Database
4. Fitur Utama
5. Logika Skoring (Metode)
6. Panduan Instalasi
7. Daftar Akun Demo

---

## 1. DESKRIPSI SISTEM

**GERD Care** adalah aplikasi berbasis web yang dirancang untuk membantu deteksi dini risiko penyakit *Gastroesophageal Reflux Disease (GERD)*. Sistem ini memungkinkan pasien melakukan skrining mandiri melalui kuesioner medis dan mendapatkan umpan balik, diagnosis sementara, serta saran klinis dari dokter/admin secara daring.

Sistem ini memiliki dua aktor utama:

* **Pasien:** Melakukan skrining, melihat riwayat, dan mencetak laporan medis.
* **Admin (Dokter/Medis):** Memantau dashboard, menganalisis jawaban pasien, dan memberikan diagnosa.

---

## 2. ARSITEKTUR & TEKNOLOGI

Sistem ini dibangun menggunakan pola desain **MVC (Model-View-Controller)** murni tanpa framework untuk performa ringan dan fleksibilitas.

### A. Tech Stack

* **Bahasa Pemrograman:** PHP Native (v7.4 / v8.x)
* **Database:** MySQL (MariaDB)
* **Frontend:** Bootstrap 5.3
* **Icons:** Bootstrap Icons
* **Visualisasi:** Chart.js
* **Tables:** DataTables
* **Web Server:** Apache (XAMPP)

### B. Struktur Folder (MVC)

```
/gerd-care
├── /app
│   ├── /config       # Konfigurasi Database & Base URL
│   ├── /controllers  # Logika (Admin, Auth, Pasien)
│   ├── /core         # Mesin Utama (App, Controller, Database Wrapper)
│   ├── /models       # Query SQL (User_model, Screening_model)
│   └── /views        # File Tampilan (HTML/PHP)
├── /public
│   ├── /css          # Stylesheet
│   ├── /img          # Logo & aset
│   └── index.php     # Entry Point Aplikasi
└── .htaccess         # Pretty URL
```

---

## 3. DESAIN DATABASE

**Nama Database:** `db_gerd_screening`

### Tabel: `users`

Menyimpan data otentikasi dan demografi pasien.

* **Primary Key:** id
* **Kolom Penting:** email, password (hash), role, nik, nama_lengkap, tgl_lahir, jenis_kelamin, alamat, no_hp, pekerjaan.

### Tabel: `screenings`

Menyimpan hasil tes & rekam medis.

* **Primary Key:** id
* **Foreign Key:** user_id
* **Kolom Penting:** total_skor, kategori_risiko, detail_jawaban (JSON), diagnosa, feedback_admin, tanggal_feedback.

---

## 4. FITUR UTAMA

### A. Modul Pasien

* Registrasi lengkap sesuai standar rekam medis.
* Skrining Mandiri: 30 pertanyaan (gejala, faktor risiko, pola makan, gaya hidup).
* Dashboard riwayat skrining.
* Laporan medis digital lengkap.
* Cetak PDF otomatis format A4 dengan kop surat & tanda tangan digital.

### B. Modul Admin

* Dashboard statistik lengkap.
* Grafik Donut & Bar Chart.
* Manajemen pasien dengan tabel pencarian & pagination.
* Melihat detail jawaban (JSON → tabel).
* Form diagnosa & feedback dokter.
* Export data screening ke CSV.

---

## 5. LOGIKA SKORING (METODE)

Setiap pertanyaan menggunakan skala Likert:

* **Tidak Pernah:** 0 poin
* **Kadang-kadang:** 1 poin
* **Sering:** 2 poin

Total 30 pertanyaan → Maksimum **60 poin**.

### Interpretasi Risiko

| Range Skor | Kategori Risiko | Warna  |
| ---------- | --------------- | ------ |
| 0 – 15     | Rendah          | Hijau  |
| 16 – 30    | Sedang          | Kuning |
| ≥ 31       | Tinggi          | Merah  |

---

## 6. PANDUAN INSTALASI

### Persiapan

1. Install XAMPP dan jalankan Apache + MySQL.
2. Simpan project pada `C:/xampp/htdocs/project-gerd`.

### Setup Database

1. Buka `localhost/phpmyadmin`.
2. Buat database baru: `db_gerd_screening`.
3. (Opsional) Import SQL jika tersedia.
4. Atau gunakan fitur Seeder.

### Konfigurasi Sistem

Edit `app/config/config.php`:

* Sesuaikan: **DB_NAME, DB_USER, DB_PASS**.
* Sesuaikan BASEURL → `http://localhost/project-gerd/public`.

### Seeding Data

Akses:

```
http://localhost/project-gerd/public/seeder.php
```

Setelah selesai muncul pesan **"SEEDING SELESAI"**.

### Menjalankan Aplikasi

Akses:

```
http://localhost/project-gerd/public
```

---

## 7. DAFTAR AKUN DEMO

### 👨‍⚕️ Admin

* **Email:** [admin@gerd.com](mailto:admin@gerd.com)
* **Password:** admin123

### 👤 Contoh Pasien

* **Email:** [budi12@gmail.com](mailto:budi12@gmail.com) *(angka belakang random dari Seeder)*
* **Password:** 123456

---

**Dokumentasi ini siap ditempel ke file README.md.**
