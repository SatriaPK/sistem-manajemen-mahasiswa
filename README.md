```
███╗   ███╗██╗  ██╗███████╗    ███████╗██╗   ██╗███████╗
████╗ ████║██║  ██║██╔════╝    ██╔════╝╚██╗ ██╔╝██╔════╝
██╔████╔██║███████║███████╗    ███████╗ ╚████╔╝ ███████╗
██║╚██╔╝██║██╔══██║╚════██║    ╚════██║  ╚██╔╝  ╚════██║
██║ ╚═╝ ██║██║  ██║███████║    ███████║   ██║   ███████║
╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝    ╚══════╝   ╚═╝   ╚══════╝
// SISTEM MANAJEMEN MAHASISWA v1.0.0
```

> **MAHASISWA SYS** — Aplikasi manajemen data akademik berbasis web dengan tampilan retro terminal, dibangun di atas Laravel 13.

---

## STACK

| Layer     | Teknologi                        |
|-----------|----------------------------------|
| Framework | Laravel 13                       |
| Language  | PHP ^8.3                         |
| Database  | SQLite                           |
| Auth      | Laravel Sanctum                  |
| Frontend  | Blade + Vite                     |
| UI Theme  | Press Start 2P · JetBrains Mono  |
| API       | RESTful JSON API                 |
| Deploy    | Railway                          |

---

## FITUR

```
[✓] AUTH          — Login & session management
[✓] DASHBOARD     — Statistik ringkas + tabel mahasiswa terbaru
[✓] MAHASISWA     — CRUD data mahasiswa (Nama, NIM, Prodi)
[✓] FAKULTAS      — CRUD data fakultas dengan daftar prodi
[✓] PRODI         — CRUD program studi (terhubung ke Fakultas)
[✓] REST API      — Endpoint JSON untuk data mahasiswa
```

---

## STRUKTUR DATABASE

```
fakultas
  └── id, nama, created_at, updated_at

prodis
  └── id, nama, fakultas_id → fakultas, created_at, updated_at

mahasiswas
  └── id, nama, nim (unique), prodi_id → prodis, created_at, updated_at

users
  └── id, name, email, password
```

Relasi antar tabel:
- `Fakultas` → punya banyak `Prodi`
- `Prodi` → milik satu `Fakultas`, punya banyak `Mahasiswa`
- `Mahasiswa` → milik satu `Prodi` (dan otomatis tahu `Fakultas`-nya lewat relasi)

---

## INSTALASI

### Prasyarat

- PHP >= 8.3
- Composer
- Node.js & NPM

### Setup Cepat

```bash
# 1. Clone repository
git clone <repo-url>
cd sistem-manajemen-mahasiswa

# 2. Jalankan setup otomatis
composer run setup
```

Script `composer run setup` akan menjalankan langkah berikut secara otomatis:
1. `composer install`
2. Salin `.env.example` → `.env`
3. Generate application key
4. Jalankan migrasi database
5. `npm install` + `npm run build`

### Setup Manual

Kalau mau lebih kontrol atau ada langkah yang gagal di setup otomatis:

```bash
composer install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate

npm install
npm run build
```

---

## MENJALANKAN APLIKASI

```bash
# Development mode — server, queue, logs, dan vite jalan bersamaan
composer run dev
```

Buka browser dan akses: `http://localhost:8000`

**Akun default (seeder):**
```
Email    : admin@mahasiswa.app
Password : password
```

---

## STRUKTUR PROYEK

```
sistem-manajemen-mahasiswa/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/
│   │       │   └── MahasiswaController.php   # REST API handler
│   │       ├── Auth/
│   │       │   └── LoginController.php
│   │       ├── DashboardController.php
│   │       ├── FakultasController.php
│   │       ├── MahasiswaController.php
│   │       └── ProdiController.php
│   └── Models/
│       ├── Fakultas.php
│       ├── Mahasiswa.php
│       ├── Prodi.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── dashboard.blade.php
│       ├── mahasiswa/  (index, show, create, edit)
│       ├── fakultas/   (index, show, create, edit)
│       └── prodi/      (index, create, edit)
└── routes/
    ├── web.php                                # Route halaman web
    └── api.php                                # Route REST API
```

---

## REST API

Base URL: `/api`

Semua endpoint mengembalikan response dalam format JSON. Request body untuk `POST` dan `PUT` harus menggunakan `Content-Type: application/json`.

### Endpoints

| Method     | Endpoint                | Deskripsi                   |
|------------|-------------------------|-----------------------------|
| `GET`      | `/api/mahasiswa`        | Ambil semua data mahasiswa  |
| `GET`      | `/api/mahasiswa/{id}`   | Ambil detail satu mahasiswa |
| `POST`     | `/api/mahasiswa`        | Tambah mahasiswa baru       |
| `PUT`      | `/api/mahasiswa/{id}`   | Update data mahasiswa       |
| `DELETE`   | `/api/mahasiswa/{id}`   | Hapus data mahasiswa        |

### Contoh Request Body (POST / PUT)

```json
{
  "nama": "Budi Santoso",
  "nim": "2024001234",
  "prodi_id": 1
}
```

### Contoh Response — GET `/api/mahasiswa/{id}`

```json
{
  "success": true,
  "message": "Detail data mahasiswa berhasil diambil",
  "data": {
    "id": 1,
    "nama": "Budi Santoso",
    "nim": "2024001234",
    "prodi_id": 1,
    "created_at": "2026-04-07T12:14:53.000000Z",
    "updated_at": "2026-04-07T12:14:53.000000Z",
    "prodi": {
      "id": 1,
      "nama": "S1 Informatika",
      "fakultas": {
        "id": 2,
        "nama": "Sains dan Teknologi"
      }
    }
  }
}
```

### Contoh Response — POST `/api/mahasiswa`

```json
{
  "success": true,
  "message": "Data mahasiswa berhasil ditambahkan",
  "data": {
    "id": 5,
    "nama": "Budi Santoso",
    "nim": "2024001234",
    "prodi_id": 1
  }
}
```

### Contoh Response — DELETE `/api/mahasiswa/{id}`

```json
{
  "success": true,
  "message": "Data mahasiswa berhasil dihapus"
}
```

### Kode Route API (`routes/api.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaController;

Route::get('/mahasiswa',          [MahasiswaController::class, 'index']);
Route::post('/mahasiswa',         [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/{id}',     [MahasiswaController::class, 'show']);
Route::put('/mahasiswa/{id}',     [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}',  [MahasiswaController::class, 'destroy']);
```

---

## TESTING

```bash
composer run test
```

---

## DEPLOYMENT

Aplikasi ini di-deploy ke **Railway**. Untuk deploy ulang atau ke platform lain, pastikan:

1. Set environment variable `APP_ENV=production` dan `APP_KEY`
2. Jalankan `php artisan migrate --force` setelah deploy
3. Pastikan `APP_URL` di `.env` sesuai dengan domain yang dipakai

---

## LISENSI

MIT License — bebas digunakan dan dimodifikasi.