<p align="center">
    <img src="https://raw.githubusercontent.com/aditrachman/MauRun/main/public/assets/logo.png" width="200" alt="MauRun Logo">
</p>

# MauRun 🏃‍♂️

Platform pendaftaran event lari Indonesia — dari 3K sampai Full Marathon.

## Fitur

- 🏅 **Event Lari** — Temukan berbagai event lari dari seluruh Indonesia
- 📝 **Pendaftaran Online** — Daftar dalam hitungan menit
- 🎫 **Kode Diskon** — Gunakan kode D-10, D-20, atau D-50
- 👥 **Manajemen Event** — Kelola event, kuota, dan pendaftaran
- 🏙️ **Multi Kota** — Event tersedia di berbagai kota

## Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade + Tailwind CSS 3
- **Database:** MySQL
- **Font:** Inter, Playfair Display, JetBrains Mono
- **Build:** Vite

## Cara Install

```bash
git clone https://github.com/aditrachman/MauRun.git
cd MauRun
composer install
npm install
cp .env.example .env
php artisan key:generate
# setup database di .env
php artisan migrate --seed
npm run build
php artisan serve
```

## Akun Demo

| Role | Email | Password |
|------|-------|----------|
| **Admin (Penyelenggara)** | `admin@maurun.com` | `password` |
| **Peserta** | `peserta@maurun.com` | `password` |

## Credits

**Muhammad Aditya Rachman** — 2405040018  
Tugas Mata Kuliah Pemrograman Web 2
