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
git clone https://github.com/username/api-sembalun.git
cd api-sembalun

2. Install Dependencies

composer install
composer require tymon/jwt-auth

3. Setup JWT Authentication

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret

4. Konfigurasi File .env

cp .env.example .env
php artisan key:generate

    Sesuaikan konfigurasi database di .env:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=api_sembalun  
DB_USERNAME=root  
DB_PASSWORD=

5. Setup Database

php artisan migrate
php artisan db:seed

6. Jalankan Server

php artisan serve

Akses API melalui: http://localhost:8000
Akun Uji Coba
Admin

    Email: admin@example.com

    Password: password

Pengunjung

    Email: user@example.com

    Password: password

Dokumentasi API

📎 Link ke Dokumentasi Postman
Daftar Endpoint (Base URL: http://localhost:8000/api)
Autentikasi

    POST /register – Registrasi pengguna baru

    POST /login – Login dan menerima token JWT

Pengunjung

    GET /pengunjung – Ambil semua data pengunjung

    POST /pengunjung – Tambah pengunjung

    PUT /pengunjung/{id} – Edit pengunjung

    DELETE /pengunjung/{id} – Hapus pengunjung

Kunjungan

    GET /kunjungan – Ambil semua kunjungan

    POST /kunjungan – Catat kunjungan

    PUT /kunjungan/{id} – Edit kunjungan

    DELETE /kunjungan/{id} – Hapus kunjungan

    Semua endpoint (kecuali register/login) memerlukan Authorization Header:
    Authorization: Bearer <token>

Contoh Request (POST /kunjungan)

Header:

Authorization: Bearer <token JWT>
Content-Type: application/json

Body:

{
  "pengunjung_id": 1,
  "tanggal_kunjungan": "2025-07-19",
  "tujuan": "Bukit Selong"
}

License

Sistem ini dibangun menggunakan Laravel dan dilisensikan di bawah MIT License.


Jika kamu mau saya bantu buatkan **struktur folder Laravel + isi file README.md langsung dalam proyek** (ZIP)