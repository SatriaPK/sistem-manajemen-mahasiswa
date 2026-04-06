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

| Layer     | Teknologi                         |
|-----------|-----------------------------------|
| Framework | Laravel 13                        |
| Language  | PHP ^8.3                          |
| Database  | SQLite                            |
| Auth      | Laravel Sanctum                   |
| Frontend  | Blade + Vite                      |
| UI Theme  | Press Start 2P · JetBrains Mono   |
| API       | RESTful JSON API                  |

---

## FITUR

```
[✓] AUTH          — Login & session management
[✓] DASHBOARD     — Statistik ringkas + tabel mahasiswa terbaru
[✓] MAHASISWA     — CRUD data mahasiswa (Nama, NIM, Prodi)
[✓] FAKULTAS      — CRUD data fakultas
[✓] PRODI         — CRUD program studi (terhubung ke Fakultas)
[✓] REST API      — Endpoint JSON untuk data mahasiswa
```

---

## STRUKTUR DATABASE

```
fakultas
  └── id, nama

prodis
  └── id, nama, fakultas_id → fakultas

mahasiswas
  └── id, nama, nim (unique), prodi_id → prodis

users
  └── id, name, email, password
```

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

Script `composer run setup` akan menjalankan:
1. `composer install`
2. Salin `.env.example` → `.env`
3. Generate application key
4. Jalankan migrasi database
5. `npm install` + `npm run build`

### Setup Manual

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
# Development mode (server + queue + logs + vite berjalan bersamaan)
composer run dev
```

Akses aplikasi di: `http://localhost:8000`

---

## REST API

Base URL: `/api`

| Method   | Endpoint              | Deskripsi                  |
|----------|-----------------------|----------------------------|
| `GET`    | `/api/mahasiswa`      | Ambil semua data mahasiswa |
| `POST`   | `/api/mahasiswa`      | Tambah mahasiswa baru      |
| `PUT`    | `/api/mahasiswa/{id}` | Update data mahasiswa      |
| `DELETE` | `/api/mahasiswa/{id}` | Hapus data mahasiswa       |

### Contoh Request Body (POST / PUT)

```json
{
  "nama": "Budi Santoso",
  "nim": "2024001234",
  "prodi_id": 1
}
```

### Contoh Response

```json
{
  "success": true,
  "message": "Data mahasiswa berhasil ditambahkan",
  "data": {
    "id": 1,
    "nama": "Budi Santoso",
    "nim": "2024001234",
    "prodi_id": 1
  }
}
```

---

## STRUKTUR PROYEK

```
sistem-manajemen-mahasiswa/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/
│   │       │   └── MahasiswaController.php   # REST API
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
│       ├── layouts/app.blade.php             # Layout utama
│       ├── dashboard.blade.php
│       ├── mahasiswa/  (index, show, create, edit)
│       ├── fakultas/   (index, show, create, edit)
│       └── prodi/      (index, create, edit)
└── routes/
    ├── web.php
    └── api.php
```

---

## TESTING

```bash
composer run test
```

---

## LISENSI

MIT License — bebas digunakan dan dimodifikasi.
