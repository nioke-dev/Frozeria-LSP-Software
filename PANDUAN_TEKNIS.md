# Panduan Teknis Frozeria (Untuk Diskusi Asesor)

Dokumen ini menjelaskan teknologi "cerdas" yang kita gunakan agar Anda bisa menjawab pertanyaan asesor dengan lancar.

## 1. Apa itu Alpine.js?
Alpine.js adalah framework JavaScript yang sangat ringan. Kita menggunakannya karena **"Tidak perlu file JS terpisah, cukup tulis di dalam HTML"**. Ini membuat kode kita lebih bersih dan cepat.

### Kata Kunci (Directives) yang Kita Pakai:

*   **`x-data`**: Digunakan untuk menyimpan data (variabel).
    *   *Contoh di App Layout:* `x-data="{ sidebarOpen: true }"` artinya kita membuat variabel `sidebarOpen` yang nilai awalnya adalah `true` (sidebar terbuka).
*   **`@click`**: Sama dengan `onclick` di JavaScript biasa.
    *   *Contoh:* `@click="sidebarOpen = !sidebarOpen"` artinya saat tombol diklik, balikkan nilai `sidebarOpen` (jika buka jadi tutup, jika tutup jadi buka).
*   **`:class`**: Mengubah tampilan (class CSS) secara otomatis berdasarkan variabel.
    *   *Contoh:* `:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"` artinya jika `sidebarOpen` bernilai true, pakai class `translate-x-0`, jika false pakai `-translate-x-full`.
*   **`x-show`**: Menampilkan atau menyembunyikan elemen (seperti `display: none`).
*   **`$dispatch`**: Mengirimkan "sinyal" antar elemen.
    *   *Contoh:* Saat tombol hapus diklik: `@click="$dispatch('open-delete-modal', { id: 1, name: 'Ayam' })"`. Ini seperti memanggil fungsi tapi antar elemen yang berbeda.
*   **`@open-delete-modal.window`**: Modal kita "mendengarkan" sinyal tersebut di seluruh jendela browser. Begitu sinyal diterima, modal langsung mengambil data `id` dan `name` tersebut untuk ditampilkan.
*   **`x-transition`**: Digunakan untuk animasi. Tanpa ini modal akan muncul kaku, dengan ini modal akan muncul halus (fade in & slide up).
*   **`:action`**: Mengubah URL form secara dinamis. Jika kita mau hapus barang ID 5, URL-nya otomatis jadi `/items/5`.

---

## 2. Mengapa pakai Tailwind CSS 4?
Jika ditanya asesor: "Kenapa tidak pakai Bootstrap?"
**Jawaban Anda:** "Saya menggunakan Tailwind CSS 4 karena lebih fleksibel untuk membuat desain yang **custom dan premium**. Tailwind 4 juga jauh lebih cepat karena sudah terintegrasi langsung dengan mesin *bundling* Vite di Laravel 11, sehingga performa aplikasi lebih ringan."

---

## 3. Penjelasan Database & Logic
*   **Model Scopes:** Kita menggunakan `scopeLowStock` dan `scopeOutOfStock` agar logika perhitungan barang tidak menumpuk di Controller. Ini mengikuti prinsip **Clean Code** (Fat Model, Skinny Controller).
*   **Eloquent Relationships:** Kita menggunakan `hasMany` dan `belongsTo` agar pengambilan data antar tabel (Kategori & Barang) terjadi secara otomatis dan aman (menghindari SQL Injection).

---

## 4. Cara Menjawab Saat Live Code
Jika asesor minta: "Coba buat tombol ini kalau diklik memunculkan alert pakai Alpine."
**Langkah Anda:**
1. Tambahkan `x-data="{ open: false }"` di elemen pembungkus.
2. Tambahkan `@click="alert('Halo Asesor!')"` di tombolnya.

*Tips: Selalu katakan bahwa Anda memilih teknologi ini karena efisiensi waktu pengerjaan dan kemudahan pemeliharaan kode (maintainability).*
