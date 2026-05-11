# Development Log - Frozeria Stock Opname

Catatan langkah-langkah yang telah diselesaikan dalam pembangunan aplikasi Frozeria.

## [DONE] Langkah 1: Inisialisasi Proyek & Git
- Membuat proyek Laravel 11 terbaru.
- Konfigurasi **Tailwind CSS 4** (terintegrasi dengan Vite).
- Inisialisasi Git dan push awal ke GitHub: `https://github.com/nioke-dev/Frozeria-LSP-Software.git`.
- Konfigurasi aplikasi (App Key, App Name).

## [DONE] Langkah 2: Entitas Kategori (Category)
- Membuat Model `Category`.
- Membuat Migration `categories` dengan kolom: `name` (unique), `description`.

## [DONE] Langkah 3: Entitas Barang (Item)
- Membuat Model `Item`.
- Membuat Migration `items` dengan kolom lengkap:
    - `category_id` (foreign key)
    - `name`, `unit`, `weight`, `storage_location`
    - `stock`, `min_stock` (default 20)
    - `buy_price`, `sell_price`
    - `description`, `image_path`

## [DONE] Langkah 4: Setup Database (MySQL)
- Konfigurasi PHP: Mengaktifkan ekstensi `pdo_sqlite`, `sqlite3` (awalnya), lalu pindah ke **MySQL**.
- Konfigurasi `.env`: Mengatur koneksi ke database MySQL `db_frozeria_lsp`.
- Eksekusi `php artisan migrate`: Semua tabel (users, categories, items) berhasil dibuat di MySQL.

## [DONE] Langkah 5: Logic & Relasi Model
- **Model Category:** Menambahkan relasi `hasMany` ke Item dan `fillable`.
- **Model Item:**
    - Menambahkan relasi `belongsTo` ke Category.
    - Menambahkan `scopeLowStock()`: Filter barang dengan stok < `min_stock`.
    - Menambahkan `scopeOutOfStock()`: Filter barang dengan stok = 0.
    - Menambahkan `fillable` untuk semua kolom.

## [DONE] Langkah 6: Dummy Data (Seeder)
- Membuat `CategorySeeder`: Mengisi data kategori Ayam, Seafood, Sapi, Sayuran, Siap Saji.
- Membuat `ItemSeeder`: Mengisi data barang contoh (Ayam Nugget, Sosis, Dimsum, dll.) dengan variasi stok (Normal, Menipis, Habis).
- Eksekusi `php artisan db:seed`: Database MySQL sekarang sudah terisi data demo.

## [DONE] Langkah 7: Controller & Routing
- Membuat 4 Controller: `DashboardController`, `ItemController`, `CategoryController`, `HelpController`.
- Konfigurasi `web.php`: Menyiapkan rute untuk semua fitur utama aplikasi.
- Implementasi Logika Dashboard: Menghitung statistik (total barang, kategori, stok rendah/habis) dan fitur filter pencarian.

## [DONE] Langkah 8: Base Layout (UI Premium)
- Membuat `layouts/app.blade.php`: Kerangka utama aplikasi.
- Mengintegrasikan **Tailwind CSS 4** dan **Alpine.js**.
- Desain Sidebar & Navbar modern dengan navigasi yang responsif.
- Menyiapkan sistem notifikasi (toast) untuk pesan sukses.

## [DONE] Langkah 9: Dashboard View (Daftar Barang)
- Membuat `dashboard/index.blade.php`: Halaman utama aplikasi.
- Implementasi 4 Card Statistik (Total Barang, Kategori, Stok Menipis, Stok Habis).
- Implementasi Fitur Filter (Search & Category) dan Tabel Barang yang responsif.
- Penandaan warna otomatis untuk status stok (Normal, Menipis, Habis).

## [DONE] Langkah 10: Komponen Modal Konfirmasi Hapus
- Membuat `components/delete-modal.blade.php`: Modal konfirmasi hapus yang dapat digunakan ulang (reusable).
- Menggunakan **Alpine.js** untuk menangani pembukaan modal secara dinamis tanpa reload halaman.
- Implementasi transisi animasi halus dan backdrop blur untuk kesan premium.

---
*Log ini akan terus diperbarui seiring berjalannya project.*
