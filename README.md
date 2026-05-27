# 💻 SISTEM PAKAR DIAGNOSA KERUSAKAN HARDWARE KOMPUTER
## Metode Forward Chaining & Certainty Factor

![Laravel Version](https://img.shields.io/badge/Laravel-11.0-red)
![PHP Version](https://img.shields.io/badge/PHP-8.3+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)
![License](https://img.shields.io/badge/License-MIT-green)

> Sistem pakar berbasis web untuk mendiagnosa kerusakan hardware komputer menggunakan metode **Forward Chaining** dan **Certainty Factor**. Aplikasi ini membantu pengguna komputer dalam melakukan diagnosis awal terhadap kerusakan hardware yang dialami beserta penyebab dan solusi untuk mengatasi kerusakan tersebut.

---

## 📋 DAFTAR ISI

- [Tentang Proyek](#-tentang-proyek)
- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#-konfigurasi-database)
- [Struktur Database](#-struktur-database)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Struktur Proyek](#-struktur-proyek)
- [Pengembang](#-pengembang)
- [Lisensi](#-lisensi)
- [Referensi](#-referensi)

---

## 🎯 TENTANG PROYEK

Komputer sudah menjadi kebutuhan utama untuk menunjang kinerja manusia. Komputer juga sering mengalami kerusakan Hardware seperti prosesor, VGA, motherboard, memori, mouse, keyboard, hard disk, drive optik, monitor. Sampai saat ini banyak pengguna komputer yang masih awam terhadap diagnosa awal kerusakan Hardware komputer yang menyebabkan banyak pengguna komputer mengeluarkan biaya yang tidak sedikit untuk mengetahui dan memperbaiki kerusakan yang terjadi pada Hardware komputernya.

Proyek ini mengimplementasikan **Sistem Pakar** dengan metode **Forward Chaining** dan **Certainty Factor** untuk:

- Mendiagnosa kerusakan hardware komputer berdasarkan gejala yang dialami
- Menghitung tingkat keyakinan (Certainty Factor) dari hasil diagnosa
- Memberikan informasi penyebab kerusakan
- Memberikan solusi perbaikan
- Menyimpan riwayat konsultasi

### Referensi Penelitian
Saputra, O., Fitri, I., & Handayani, E. T. E. (2022). Sistem Pakar Diagnosa Kerusakan Hardware Komputer Menggunakan Metode Forward Chaining dan Certainty Factor Berbasis Website. *Jurnal JTIK (Jurnal Teknologi Informasi dan Komunikasi)*, 6(2), 234-242.

---

## ✨ FITUR

### Core Features
| Fitur | Deskripsi |
|-------|------------|
| 🖥️ **Diagnosa Hardware** | Mendiagnosa 9+ kerusakan hardware komputer |
| 🔍 **Forward Chaining** | Pelacakan maju dari fakta/gejala ke kesimpulan |
| 📊 **Certainty Factor** | Perhitungan tingkat keyakinan hasil diagnosa |
| 📝 **Riwayat Konsultasi** | Menyimpan dan melihat riwayat konsultasi |
| 🖨️ **Cetak Hasil** | Mencetak hasil diagnosa |

### User Features (5 Step Konsultasi)
| Step | Fitur | Deskripsi |
|------|-------|------------|
| 1 | 📝 **Input Biodata** | Form input nama, jenis kelamin, dan umur |
| 2 | ✅ **Pilih Gejala** | 21+ gejala dengan tingkat keyakinan (1.0 - 0.2) |
| 3 | ⚙️ **Forward Chaining** | Sistem mencari rule yang cocok dengan gejala |
| 4 | 🧮 **Certainty Factor** | Perhitungan tingkat kepastian hasil |
| 5 | 📋 **Hasil Diagnosa** | Menampilkan kerusakan, penyebab, solusi, dan CF |

### Admin Features
| Fitur | Deskripsi |
|-------|------------|
| 📊 **Dashboard** | Statistik data kerusakan, gejala, rule, konsultasi |
| 🖥️ **Data Kerusakan** | CRUD data kerusakan (kode, nama, penyebab, solusi) |
| ⚠️ **Data Gejala** | CRUD data gejala (kode, nama gejala) |
| 🔗 **Basis Pengetahuan** | Relasi gejala → kerusakan dengan nilai MB & MD |
| 📜 **Riwayat Konsultasi** | Lihat semua hasil diagnosa user |
| 🔑 **Ubah Password** | Mengganti password admin |

### Additional Features
| Fitur | Deskripsi |
|-------|------------|
| 📞 **Kontak Pengembang** | Form untuk menghubungi pengembang |
| 🧮 **Lihat Rumus CF** | Menampilkan detail perhitungan Certainty Factor |
| 📊 **Tabel Ranking** | Ranking semua kemungkinan kerusakan |
| 🎨 **Responsive Design** | Tampilan responsif untuk semua device |

---

## 🛠 TEKNOLOGI

### Backend
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **PHP** | >= 8.3 | Bahasa pemrograman |
| **Laravel** | 11.0 | Framework PHP |
| **MySQL** | >= 5.7 | Database |
| **Composer** | Latest | Dependency manager |

### Frontend
| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Bootstrap** | 5.3 | CSS Framework |
| **Bootstrap Icons** | 1.10 | Icon library |
| **JavaScript** | ES6 | Interaktivitas |

### Development Tools
| Tools | Fungsi |
|-------|--------|
| **Laragon** | Local development environment |
| **Visual Studio Code** | Code editor |
| **phpMyAdmin** | Database management |
| **Git** | Version control |

---


## 💻 PERSYARATAN SISTEM

### Minimum Requirements
```yaml
OS: Windows 10 / macOS 10.14+ / Linux (Ubuntu 18.04+)
RAM: 512 MB (1 GB recommended)
CPU: 1.0 GHz (2.0 GHz recommended)
Storage: 200 MB (1 GB recommended)

Software Requirements:
  - PHP >= 8.3
  - Composer >= 2.0
  - MySQL >= 5.7
  - Web Server (Apache/Nginx)
```  
### Recommended Requirements
```yaml
OS: Windows 11 / macOS 13+ / Ubuntu 22.04+
RAM: 2 GB or more
CPU: 2.0 GHz or more
Storage: 1 GB or more

Software:
  - Laragon (Windows) / XAMPP (Cross-platform)
  - Visual Studio Code
  - Git
```
---

## 🔧 INSTALASI

### Step 1: Clone Repository
```bash
git clone https://github.com/Satriyo62/sistem-pakar-hardware.git
cd sistem-pakar-hardware
```
### Step 2: Install Dependencies via Composer
```bash
composer install
```
### Step 3: Copy Environment File
```bash
cp .env.example .env
```
### Step 4: Generate Application Key
```bash
php artisan key:generate
```
### Step 5: Konfigurasi Database (.env)
```sql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database name
DB_USERNAME=
DB_PASSWORD=
```
### Step 6: Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```
### Step 7: Clear Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```
### Step 8: Jalankan Aplikasi
```bash
php artisan serve
```
Akses aplikasi di: http://localhost:8000

## 🗄️ KONFIGURASI DATABASE
### Membuat Database
```yaml
CREATE DATABASE db_sistem_pakar;
Migration (Struktur Tabel)
bash
php artisan migrate:refresh --seed
```
### Tabel yang dibuat:
| Tabel | Deskripsi |
|-------|--------|
| **kerusakans** | Data Kerusakan Hardware |
| **gejalas** | Data Gejala Kerusakan |
| **rules** | Relasi (basis pengetahuan) |
| **konsultasis** | Data Konsultasi User |
| **konsultasi_gejala** | Gejala yang di Pilih User |

## 📊 STRUKTUR DATABASE
### Tabel kerusakans
| Field | Type| Description |
|-------|-----|-------------|
| **id** | bigint | Primary key |
| **kode_kerusakan** | varchar(10) | KOde unik (P001-P009) |
| **nama_kerusakan** | varchar(255) | Nama Kerusakan |
| **penyebab** | text | Penyebab kerusakan |
| **solusi** | text | Solusi perbaikan |

### Tabel gejalas
| Field | Type| Description |
|-------|-----|-------------|
| **id** | bigint | Primary key |
| **kode_gejala** | varchar(10) | Kode unik (G01-G21) |
| **nama_gejala** |	varchar(255) | Nama gejala |

### Tabel rules (Basis Pengetahuan)
| **Field** |	Type |	Description |
|-----------|--------|--------------|
| **id** |	bigint |	Primary key |
| **kerusakan_id** |	bigint |	Foreign key ke kerusakans |
| **gejala_id** |	bigint |	Foreign key ke gejalas |
| **mb** |	decimal(5,2) |	Measure of Belief (0-1) |
| **md** |	decimal(5,2) |	Measure of Disbelief (0-1) |

## 🚀 MENJALANKAN APLIKASI
### Local Development
```bash
# Jalankan server development
php artisan serve

# Atau menggunakan Laragon
# Start Laragon -> klik 'Start All'
# Akses http://sistem-pakar-hardware.test
```
### Login Admin
```bash
URL: http://localhost:8000/login
# Login dengan Default:
Username: admin
Password: admin123
```
### User Access
```bash
URL: http://localhost:8000/
- Klik "Mulai Konsultasi"
- Isi biodata
- Pilih gejala dan tingkat keyakinan
- Dapatkan hasil diagnosa
```
## 📁 STRUKTUR PROYEK
```
sistem-pakar-hardware/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── GejalaController.php
│   │   │   ├── KerusakanController.php
│   │   │   ├── KonsultasiController.php
│   │   │   ├── KontakController.php
│   │   │   ├── LoginController.php
│   │   │   ├── PasswordController.php
│   │   │   └── RuleController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── Gejala.php
│       ├── Kerusakan.php
│       ├── Konsultasi.php
│       └── Rule.php
│
├── database/
│   ├── migrations/
│   │   ├── create_kerusakans_table.php
│   │   ├── create_gejalas_table.php
│   │   ├── create_rules_table.php
│   │   ├── create_konsultasis_table.php
│   │   └── create_konsultasi_gejala_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── master.blade.php
│       │   └── guest.blade.php
│       ├── kerusakan/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── gejala/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── rule/
│       │   └── index.blade.php
│       ├── konsultasi/
│       │   ├── biodata.blade.php
│       │   ├── gejala.blade.php
│       │   ├── hasil.blade.php
│       │   ├── cetak.blade.php
│       │   ├── detail_perhitungan.blade.php
│       │   └── index.blade.php
│       ├── dashboard.blade.php
│       ├── login.blade.php
│       ├── welcome.blade.php
│       ├── kontak.blade.php
│       └── ubah_password.blade.php
│
├── routes/
│   └── web.php
│
├── .env
├── composer.json
└── README.md
```
## 👥 PENGEMBANG
| **Nama** |	Peran |
|----------| ---------|
| **Satriyo Wicaksono Yunan Mubarok**	| Pengembang Aplikasi |
| **Nadia Tifara Sidiq**	| Observer |
| **Muhammad Rosyid Ridlo Abdillah**	| Observer |

Institusi: Politeknik Negeri Madiun

GitHub: https://github.com/Satriyo62

Tahun Pengembangan: 2026

## 📄 LISENSI
Proyek ini dilisensikan di bawah MIT License.

```text
MIT License

Copyright (c) 2026 - Satriyo Wicaksono Yunan Mubarok
Politeknik Negeri Madiun

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files...
```
## 📚 REFERENSI
1. Saputra, O., Fitri, I., & Handayani, E. T. E. (2022). Sistem Pakar Diagnosa Kerusakan Hardware Komputer Menggunakan Metode Forward Chaining dan Certainty Factor Berbasis Website. Jurnal JTIK (Jurnal Teknologi Informasi dan Komunikasi), 6(2), 234-242.

2. Arifin, S. (2012). Aplikasi Sistem Pakar Diagnosis Kerusakan Hardware Komputer Dengan Metode Forward Chaining. Jurnal Teknologi Informasi: Teori, Konsep, dan Implementasi, 3(1), pp.59-74.

3. Rizal, S. R. S., & Agustina, R. (2014). Sistem Pakar Diagnosa Kerusakan Komputer dengan Metode Forward Chaining dan Certainty Factor di Universitas Kanjuruhan Malang. (Doctoral dissertation, Universitas Kanjuruhan Malang).

## 🙏 ACKNOWLEDGMENT
- Politeknik Negeri Madiun - Institusi pengembangan

- Universitas Nasional - Tempat penelitian asli

- Jurnal JTIK - Publikasi penelitian

- Laravel Community - Framework dan dokumentasi

- Bootstrap Team - CSS Framework

> ⚠️ **DISCLAIMER**
>
> **Penting:** Aplikasi sistem pakar ini dibuat untuk membantu diagnosis awal kerusakan hardware komputer. Hasil diagnosa dari aplikasi ini **bukan merupakan pengganti** diagnosis dari teknisi komputer profesional. Selalu konsultasikan dengan teknisi komputer yang berpengalaman untuk hasil yang lebih akurat dan penanganan yang tepat.

<div align="center"> <i>Dibuat dengan tulus oleh Satriyo Wicaksono Yunan Mubarok</i><br> <i>Politeknik Negeri Madiun - 2026</i> </div>