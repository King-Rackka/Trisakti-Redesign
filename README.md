# 🎓 Trisakti Redesign — Web Kampus Universitas Trisakti

Redesign website kampus Universitas Trisakti menggunakan CodeIgniter 4, sebagai project UTS mata kuliah Pemrograman Web.

---

## 🌐 Demo

🔗 [webradit.gamer.gd](https://webradit.gamer.gd)

---

## 📋 Fitur

### Publik
- **Beranda** — Hero slider, statistik kampus, fakultas pilihan, profil + video YouTube, sambutan rektor, berita terkini
- **Berita** — Daftar berita dengan layout featured + grid, pagination, halaman detail berita
- **Tentang** — Sejarah singkat, Visi & Misi, Motto, Struktur Organisasi (sidebar navigasi)
- **Kontak** — Informasi kontak, media sosial, Google Maps embed
- **Alumni** — Daftar alumni dengan foto & background, halaman detail profil alumni, pagination
- **Agenda** — Daftar kegiatan/agenda kampus

### Admin Panel
- **Login** — Autentikasi berbasis database dengan session
- **Dashboard** — Navigasi ke semua menu kelola konten
- **CRUD Berita** — Tambah, edit, hapus berita dengan upload gambar
- **CRUD Alumni** — Tambah, edit, hapus data alumni dengan foto profil & background
- **CRUD Agenda** — Tambah, edit, hapus agenda/kegiatan
- **CRUD Fakultas & Prodi** — Kelola data fakultas dan program studi
- **RU Profil Kampus** — Update sejarah, visi misi, motto dengan tab interface
- **RU Kontak** — Update informasi kontak dan media sosial
- **RU Struktur Organisasi** — Update data jabatan dan nama pejabat
- **Proteksi halaman admin** — Auth filter mencegah akses tanpa login

---

## 🎯 Tujuan

Project ini dibuat untuk memenuhi tugas UTS mata kuliah Pemrograman Web dengan tujuan:
- Mempraktikkan penggunaan framework CodeIgniter 4 secara menyeluruh
- Membangun sistem CRUD dengan manajemen file (upload gambar)
- Mengimplementasikan autentikasi dan proteksi route
- Membuat tampilan web yang responsif dan menarik berbasis desain asli website Trisakti

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| **Framework** | CodeIgniter 4.7.2 |
| **Bahasa** | PHP 8.3 |
| **Frontend** | HTML, CSS, JavaScript (Vanilla) |
| **CSS Library** | Font Awesome 6.5 |
| **Database** | MySQL |
| **Web Server** | Apache |
| **Hosting** | InfinityFree |

---

## 🗄️ Struktur Database

| Tabel | Keterangan |
|---|---|
| `admin` | Akun admin untuk login panel |
| `berita` | Data berita kampus |
| `alumni` | Data alumni terkenal |
| `agenda` | Data agenda/kegiatan kampus |
| `fakultas` | Data fakultas |
| `prodi` | Data program studi per fakultas |
| `struktur` | Struktur organisasi kampus |
| `profil` | Profil kampus (sejarah, visi, misi, motto) |
| `kontak` | Informasi kontak dan media sosial |

---

## 🚀 Instalasi Lokal

### Prasyarat
- PHP >= 8.1
- MySQL
- Composer
- XAMPP / Laragon

### Langkah-langkah

**1. Clone repository:**
```bash
git clone https://github.com/King-Rackka/Trisakti-Redesign.git
cd Trisakti-Redesign
```

**2. Install dependencies:**
```bash
composer install
```

**3. Salin file environment:**
```bash
cp env .env
```

**4. Edit `.env` — sesuaikan konfigurasi database:**
```env
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = trisakti_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

**5. Buat database** bernama `trisakti_db` di phpMyAdmin.

**6. Jalankan migration:**
```bash
php spark migrate
```

**7. Buat folder upload:**
```bash
mkdir -p public/assets/news public/assets/alumni public/assets/agenda
mkdir -p public/assets/dekan public/assets/fakultas public/assets/kaprodi public/assets/prodi
```

**8. Jalankan server:**
```bash
php spark serve
```

**9. Akses di browser:**
```
http://localhost:8080
```

---

## 🔐 Login Admin

Akses halaman admin di:
```
http://localhost:8080/admin/login
```

| Field | Value |
|---|---|
| **Email** | `radityaAdmin@gmail.com` |
| **Password** | `admin123` |

> ⚠️ Disarankan untuk mengganti password setelah pertama kali login.

---

## 📁 Struktur Folder Penting

```
projeck_uts_trisakti/
├── app/
│   ├── Controllers/
│   │   ├── Admin.php          # Semua controller admin
│   │   ├── Home.php           # Halaman beranda
│   │   ├── News.php           # Halaman berita publik
│   │   ├── TentangController.php
│   │   ├── Alumni.php
│   │   └── Kontak.php
│   ├── Models/
│   ├── Views/
│   │   ├── layouts/           # Layout utama (main.php, admin.php)
│   │   ├── admin/             # Semua view admin
│   │   ├── alumni/
│   │   ├── Tentang/
│   │   └── kontak/
│   ├── Filters/
│   │   └── AuthFilter.php     # Filter autentikasi admin
│   └── Database/
│       └── Migrations/        # Semua migration tabel
└── public/
    └── assets/                # Gambar dan file statis
```

---

## 👤 Developer

**Nama:** Raditya  
**Mata Kuliah:** Pemrograman Web  
**Institusi:** Universitas Trisakti  

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik.  
Data dan konten mengacu pada website resmi [Universitas Trisakti](https://trisakti.ac.id).
