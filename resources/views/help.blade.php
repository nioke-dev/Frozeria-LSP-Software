@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto pb-20 px-4">
    <!-- Hero Header -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-black text-gray-900 tracking-tight mb-4">Manual Penggunaan Digital</h1>
        <p class="text-gray-500 font-bold max-w-3xl mx-auto italic border-l-4 border-orange-500 pl-6 text-base leading-relaxed">Panduan komprehensif operasional sistem manajemen stok <span class="text-orange-600 font-black">Frozeria</span> - Standar Sertifikasi LSP.</p>
    </div>

    <!-- MAIN NAVIGATION FOR HELP (Unified Orange/Amber) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16 text-center">
        <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40">
            <h4 class="text-2xl font-black text-orange-600 mb-1 italic">01.</h4>
            <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Manajemen Barang</p>
        </div>
        <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40">
            <h4 class="text-2xl font-black text-orange-500 mb-1 italic">02.</h4>
            <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Manajemen Kategori</p>
        </div>
        <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40">
            <h4 class="text-2xl font-black text-amber-600 mb-1 italic">03.</h4>
            <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Monitoring Stok</p>
        </div>
    </div>

    <!-- SECTION 1: MANAJEMEN BARANG (CRUD LENGKAP) -->
    <div class="space-y-10 mb-24">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight flex items-center gap-4">
            <span class="w-12 h-1.5 bg-orange-600 rounded-full"></span>
            I. Panduan Lengkap Manajemen Barang
        </h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Create & Read -->
            <div class="bg-white p-10 rounded-[50px] border border-gray-100 shadow-2xl shadow-gray-200/30 space-y-8">
                <div>
                    <h5 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 bg-orange-600 text-white rounded-xl flex items-center justify-center text-xs">1</span>
                        Menambah Data Barang Baru
                    </h5>
                    <ul class="space-y-4 ml-11 text-sm text-gray-600 font-medium leading-relaxed list-disc">
                        <li>Klik tombol <span class="font-black text-orange-600">+ Tambah Barang</span> pada halaman Dashboard utama.</li>
                        <li>Isi <span class="text-gray-900 font-black">Nama Barang</span> sesuai merk atau jenis produk.</li>
                        <li>Pilih <span class="text-gray-900 font-black">Kategori</span> yang sesuai. Jika kategori belum ada, buat terlebih dahulu di menu Kategori.</li>
                        <li>Masukkan <span class="text-gray-900 font-black">Harga Beli</span> dan <span class="text-gray-900 font-black">Harga Jual</span>. Sistem akan otomatis memformat mata uang Rupiah.</li>
                        <li>Unggah <span class="text-gray-900 font-black">Foto Produk</span> (format JPG/PNG, maks 2MB).</li>
                        <li>Klik <span class="px-3 py-1 bg-orange-600 text-white rounded-lg text-[10px] font-black">Simpan Barang</span>.</li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-xl flex items-center justify-center text-xs">2</span>
                        Melihat Detail & Analisis
                    </h5>
                    <p class="ml-11 text-sm text-gray-600 font-medium leading-relaxed italic mb-4">Fitur ini digunakan untuk melihat transparansi data satu produk secara mendalam:</p>
                    <ul class="space-y-4 ml-11 text-sm text-gray-600 font-medium leading-relaxed">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Klik ikon <span class="font-black text-blue-600">Mata Biru</span> pada tabel barang. Di sini Anda akan melihat foto produk dan kalkulasi <span class="text-green-600 font-black underline italic">Estimasi Keuntungan</span> per unit barang secara otomatis.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Update & Delete -->
            <div class="bg-white p-10 rounded-[50px] border border-gray-100 shadow-2xl shadow-gray-200/30 space-y-8">
                <div>
                    <h5 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 bg-amber-500 text-white rounded-xl flex items-center justify-center text-xs">3</span>
                        Memperbarui (Update) Data
                    </h5>
                    <ul class="space-y-4 ml-11 text-sm text-gray-600 font-medium leading-relaxed">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span>Klik ikon <span class="font-black text-orange-600">Pensil Oranye</span> untuk mengubah informasi seperti stok masuk atau harga. Anda tidak wajib mengunggah ulang foto jika tidak ada perubahan gambar.</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-black text-gray-900 mb-4 flex items-center gap-3">
                        <span class="w-8 h-8 bg-red-600 text-white rounded-xl flex items-center justify-center text-xs">4</span>
                        Menghapus Data Secara Aman
                    </h5>
                    <div class="ml-11 p-6 bg-red-50 rounded-3xl border border-red-100">
                        <p class="text-xs text-red-700 font-bold leading-relaxed mb-4">Sistem dilengkapi dengan <span class="font-black italic underline">Security Modal Confirmation</span>:</p>
                        <ol class="space-y-3 text-[11px] font-black text-red-600/80 uppercase tracking-widest">
                            <li>1. Klik ikon Tempat Sampah Merah.</li>
                            <li>2. Baca konfirmasi yang muncul.</li>
                            <li>3. Klik "Ya, Hapus Data" untuk mengeksekusi.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SPECIAL SECTION: KODE BARANG SKU -->
    <div class="mb-24">
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-[50px] p-10 md:p-16 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
            <!-- Refined Decorative Elements -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-[0.05] rounded-full"></div>
            <div class="absolute top-1/2 -left-20 w-40 h-40 bg-blue-400 opacity-20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-12">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center text-3xl shadow-inner">🔖</div>
                    <div>
                        <h3 class="text-2xl font-black uppercase tracking-tight leading-none">Sistem Kode Barang (SKU)</h3>
                        <p class="text-blue-100 text-[10px] font-black mt-2 italic tracking-[0.2em] uppercase opacity-80">Unique Product Identification & Anti-Duplicate System</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <div class="bg-white/10 p-8 rounded-[32px] backdrop-blur-md border border-white/10 hover:bg-white/15 transition-all duration-300 h-full">
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                Kenapa Wajib Ada?
                            </h6>
                            <p class="text-xs leading-relaxed text-blue-50 font-bold italic opacity-90">Kode Barang (SKU) digunakan untuk membedakan produk yang identik namun memiliki <span class="text-white underline decoration-blue-400 underline-offset-4">Merk berbeda</span> atau <span class="text-white underline decoration-blue-400 underline-offset-4">Kemasan berbeda</span>. Hal ini menjamin akurasi stok 100% pada gudang Frozeria.</p>
                        </div>
                    </div>
                    <div class="group">
                        <div class="bg-blue-950/20 p-8 rounded-[32px] backdrop-blur-md border border-white/5 hover:bg-blue-950/30 transition-all duration-300 h-full">
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                                Real-Time Validation
                            </h6>
                            <p class="text-xs leading-relaxed text-blue-50 font-bold italic opacity-90">Sistem secara cerdas akan mengecek database saat Anda mengetik. Jika kode sudah digunakan oleh barang lain, peringatan akan muncul secara <span class="text-orange-400 font-black underline decoration-orange-400/50 underline-offset-4">Live</span> untuk mencegah terjadinya data ganda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: MANAJEMEN KATEGORI (CRUD LENGKAP) -->
    <div class="space-y-10 mb-24">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight flex items-center gap-4">
            <span class="w-12 h-1.5 bg-orange-500 rounded-full"></span>
            II. Panduan Lengkap Manajemen Kategori
        </h2>
        
        <div class="bg-white p-10 md:p-16 rounded-[60px] border border-gray-100 shadow-2xl shadow-gray-200/30">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="space-y-4">
                    <h6 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b-2 border-orange-500 pb-2 inline-block">1. Create Kategori</h6>
                    <p class="text-xs text-gray-500 font-bold leading-relaxed italic text-justify">Buka menu <span class="text-orange-600 font-black">Kategori</span>, klik <span class="font-black text-gray-900">+ Tambah Kategori</span>. Gunakan kategori untuk mengelompokkan barang agar manajemen stok lebih teratur.</p>
                </div>
                <div class="space-y-4">
                    <h6 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b-2 border-amber-500 pb-2 inline-block">2. Update Kategori</h6>
                    <p class="text-xs text-gray-500 font-bold leading-relaxed italic text-justify">Gunakan tombol edit jika ingin mengubah nama kategori. Perubahan akan otomatis teraplikasi pada semua barang yang terhubung ke kategori tersebut.</p>
                </div>
                <div class="space-y-4">
                    <h6 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b-2 border-red-500 pb-2 inline-block">3. Delete Kategori</h6>
                    <p class="text-[11px] text-red-500 font-black leading-relaxed bg-red-50 p-4 rounded-2xl">Menghapus kategori tidak akan menghapus barang. Barang hanya akan berstatus "Tidak Berkategori" pada tabel dashboard utama.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: MONITORING & NAVIGASI -->
    <div class="space-y-10 mb-24">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight flex items-center gap-4">
            <span class="w-12 h-1.5 bg-amber-600 rounded-full"></span>
            III. Fitur Monitoring & Navigasi Canggih
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-900 p-10 rounded-[50px] shadow-2xl shadow-gray-300 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-20"><svg class="w-20 h-20 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg></div>
                <h5 class="text-lg font-black mb-10 flex items-center gap-3">
                    <span class="w-2 h-8 bg-orange-500 rounded-full"></span>
                    Sistem Alert Stok Otomatis
                </h5>
                <div class="space-y-8 relative z-10">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <p class="text-[11px] font-bold text-gray-300 leading-relaxed"><span class="text-white font-black">Total Barang & Kategori:</span> Monitor jumlah seluruh varian produk (ikon kotak) dan kelompok kategori secara terpusat.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center animate-pulse flex-shrink-0 text-white">⚠️</div>
                        <p class="text-[11px] font-bold text-gray-300 leading-relaxed"><span class="text-orange-400 font-black italic underline">Stok Menipis (Amber):</span> Alert otomatis jika stok berada di bawah batas minimum yang ditentukan.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center animate-pulse flex-shrink-0 text-white text-[10px] font-black uppercase">Habis</div>
                        <p class="text-[11px] font-bold text-gray-300 leading-relaxed"><span class="text-red-500 font-black italic underline">Stok Habis (Red):</span> Alert kritis saat stok mencapai angka nol (0), memaksa pengadaan ulang.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[50px] border border-gray-100 shadow-xl shadow-gray-200/40">
                <h5 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-3 italic underline decoration-orange-500 decoration-4">Sistem Navigasi & Pencarian</h5>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 font-black italic text-sm">01</div>
                        <p class="text-xs text-gray-500 font-bold leading-relaxed italic text-justify"><span class="text-gray-900 font-black">Live Search:</span> Ketik nama barang pada kolom pencarian dashboard. Tabel menyaring data secara <span class="text-orange-600 font-black">instan</span> tanpa muat ulang halaman.</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 font-black italic text-sm">02</div>
                        <p class="text-xs text-gray-500 font-bold leading-relaxed italic text-justify"><span class="text-gray-900 font-black">Searchable Category Filter:</span> Saring produk berdasarkan kategori. Fitur ini bersifat <span class="text-orange-600 font-black italic underline">Searchable</span>, artinya Anda bisa mencari nama kategori di dalam dropdown jika jumlah kategori sangat banyak.</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 font-black italic text-sm">03</div>
                        <p class="text-xs text-gray-500 font-bold leading-relaxed italic text-justify"><span class="text-gray-900 font-black">Ultra Pagination:</span> Sistem membagi data menjadi beberapa halaman (10 per hal. di Dashboard & 5 per hal. di Kategori) untuk menjamin kerapihan visual dan performa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LSP INFORMATION -->
    <div class="border-t-2 border-gray-100 pt-16">
        <div class="bg-white rounded-[50px] border-2 border-gray-50 shadow-2xl shadow-gray-200/50 p-12 md:p-16">
            <div class="text-center mb-16">
                <span class="px-6 py-2 bg-orange-600 text-white text-[10px] font-black rounded-full uppercase tracking-[0.4em] mb-4 inline-block shadow-lg shadow-orange-100">Informasi Detail Peserta</span>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight mt-4 uppercase">Data Lengkap Sertifikasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Nama Lengkap</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3 uppercase text-orange-600">Muhammad Nurul Mustofa</p>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Nomor Induk Mahasiswa (NIM)</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3">2241720022</p>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Kelas / Kelompok</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3 uppercase">TI-4H</p>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Program Sertifikasi</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3 italic">Pemrograman Software Komputer</p>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Nomor Telepon / WhatsApp</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3">085161644408</p>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Alamat Email</p>
                    <p class="text-xl font-black text-gray-900 tracking-tight ml-3 italic">nioke8090@gmail.com</p>
                </div>
                <div class="flex flex-col gap-2 md:col-span-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-l-2 border-orange-500 pl-3">Alamat Domisili Lengkap</p>
                    <p class="text-lg font-bold text-gray-700 ml-3 italic leading-relaxed">Dusun Krajan RT 08 RW 03 Desa Banyuanyar Lor, Gending, Probolinggo</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
