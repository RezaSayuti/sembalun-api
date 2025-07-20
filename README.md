# API Manajemen Data Pengunjung Wisata Sembalun

Proyek ini dibuat untuk memenuhi tugas Ujian Akhir Semester Mata Kuliah Web Services  
Program Studi Rekayasa Perangkat Lunak – Universitas Bumi Gora

## Anggota Kelompok

- 2201040017 - Muhammad Reza Sayuti  
- 2201040013 - Rizki Akbar Pratama

---

## Deskripsi Singkat

RESTful API berbasis Laravel yang digunakan untuk mengelola data pengunjung wisata di kawasan Sembalun.  
Fitur utama dari API ini mencakup:

- Autentikasi pengguna dengan JWT
- Manajemen data pengguna (admin dan pengunjung)
- Pencatatan kunjungan wisata
- Manajemen data destinasi wisata
- Dokumentasi API dengan Postman Collection

---

## Cara Menjalankan Sistem

### 1. Clone Repository

```bash
git clone https://github.com/rezasayuti/sembalun-api.git
cd sembalun-api
```

### 2. Install Dependencies
```bash
composer install
composer require tymon/jwt-auth
```

### 3. Setup JWT Authentication
```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```


### 4. Konfigurasi File .env
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi database di .env:
```bash
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=sembalun_db  
DB_USERNAME=root  
DB_PASSWORD=
```

### 5. Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 6. Jalankan Server
```bash
php artisan serve
```
Akses API melalui: http://localhost:8000

Untuk menggunakan API, silakan lakukan registrasi terlebih dahulu melalui endpoint:
```URL
POST http://localhost:8000/api/register
```

Contoh body JSON untuk registrasi:
```json
{
  "name": "admin",
  "email": "admin@gmail.com",
  "password": "123456"
}
```

Setelah berhasil registrasi, login melalui endpoint:
```URL
POST http://localhost:8000/api/login
```

Contoh body JSON untuk login:
```json
{
  "email": "admin@gmail.com",
  "password": "123456"
}
```
Setelah login, Anda akan menerima token yang dapat digunakan untuk mengakses endpoint lainnya menggunakan header:
```css
Authorization: Bearer {token}
```
### Dokumentasi API
📎 [Link](https://web.postman.co/workspace/My-Workspace~853f9888-2645-4ab8-8e52-b4afc85c24d0/collection/39869894-0b179bd9-84ff-4dba-adc9-08658384ec3c?action=share&source=copy-link&creator=39869894) ke Dokumentasi Postman
Daftar Endpoint (Base URL: http://localhost:8000/api)
Autentikasi
```bash
    POST /register – Registrasi pengguna baru

    POST /login – Login dan menerima token JWT
```
Pengunjung
```bash
    GET /pengunjung – Ambil semua data pengunjung

    POST /pengunjung – Tambah pengunjung

    PUT /pengunjung/{id} – Edit pengunjung

    DELETE /pengunjung/{id} – Hapus pengunjung
```
Kunjungan
```bash
    GET /kunjungan – Ambil semua kunjungan

    POST /kunjungan – Catat kunjungan

    PUT /kunjungan/{id} – Edit kunjungan

    DELETE /kunjungan/{id} – Hapus kunjungan

    Semua endpoint (kecuali register/login) memerlukan Authorization Header:
    Authorization: Bearer <token>
```
---

### Contoh Request (POST /kunjungan)

Header:
```bash
Authorization: Bearer <token JWT>
Content-Type: application/json
```
Body:
```bash
{
  "pengunjung_id": 1,
  "tanggal_kunjungan": "2025-07-19",
  "tujuan": "Bukit Selong"
}
```
---
License

Sistem ini dibangun menggunakan Laravel dan dilisensikan di bawah MIT License.
