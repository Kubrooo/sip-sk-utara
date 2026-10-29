# Project SIP-SK-Utara
Sistem Informasi Pembuatan Surat Keputusan (Produk Hukum Kecamatan)
Kecamatan Pekalongan Utara

Tech Stack:
- PHP 8.3 / Laravel 11.x
- Laravel Breeze + Spatie Laravel-Permission
- Barryvdh Laravel-Dompdf
- SimpleSoftwareIO/simple-qrcode
- Blade + Tailwind CSS + Alpine.js

## Deploy ke Shared Hosting PHP/MySQL

Project ini dapat dijalankan di shared hosting yang menyediakan PHP 8.2 atau lebih baru,
MySQL/MariaDB, dan Apache dengan `mod_rewrite`. Railway atau Render tidak diperlukan.

### 1. Siapkan file aplikasi

Jalankan di komputer lokal dari folder project:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Upload source project ke hosting melalui File Manager atau FTP. Jangan upload file `.env`
lokal. Folder `public` harus menjadi **Document Root** domain/subdomain. Jika hosting
tidak mengizinkan pengaturan Document Root, minta bantuan support hosting; jangan
memindahkan `index.php` tanpa menyesuaikan path Laravel.

Folder berikut harus dapat ditulis oleh PHP:

- `storage/`
- `bootstrap/cache/`

Jangan upload `node_modules/`. Folder `vendor/` harus ikut di-upload jika hosting tidak
menyediakan Composer atau akses SSH.

### 2. Buat database

Buat database MySQL dan user dari panel hosting, lalu isi `.env` di server:

```dotenv
APP_NAME="SIP SK Pekalongan Utara"
APP_ENV=production
APP_DEBUG=false
APP_KEY=
APP_URL=https://domain-kamu.example

SESSION_DRIVER=file
SESSION_LIFETIME=120

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database_dari_hosting
DB_USERNAME=user_database_dari_hosting
DB_PASSWORD=password_database_dari_hosting

FILESYSTEM_DISK=public
LOG_CHANNEL=stack
LOG_LEVEL=error
```

Generate `APP_KEY` satu kali sebelum upload:

```bash
php artisan key:generate --show
```

Salin hasilnya ke `APP_KEY` di `.env` server. Jangan menggunakan `APP_DEBUG=true` di
website publik.

### 3. Jalankan migration dan seed

Jika hosting memiliki SSH atau Terminal:

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan optimize
```

Jika tidak memiliki SSH, jalankan migration dan seeder dari komputer lokal yang
diarahkan ke database hosting, atau import SQL hasil export database melalui
phpMyAdmin. Setelah itu buat shortcut `public/storage` ke `storage/app/public` dari
File Manager jika fitur symlink tersedia. Tanpa shortcut tersebut, pembuatan dan
download dokumen tetap berjalan, tetapi file publik tidak dapat ditampilkan langsung.

### 4. Login awal

Seeder menyediakan akun awal untuk setiap peran. Segera ganti semua password awal
setelah login pertama dan jangan membagikan kredensial tersebut di repository atau
`.env`.

### 5. Jika muncul error 500

Periksa `storage/logs/laravel.log`, lalu pastikan:

1. PHP hosting minimal 8.2.
2. `APP_KEY` terisi.
3. Kredensial database benar.
4. `storage/` dan `bootstrap/cache/` writable.
5. Document Root mengarah ke folder `public`.
6. `.htaccess` dari folder `public` ikut ter-upload.
