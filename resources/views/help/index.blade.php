@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto pb-20 px-4">
    <!-- Hero Header -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-3">Pusat Bantuan & Panduan</h1>
        <p class="text-gray-500 font-bold max-w-2xl mx-auto italic">Informasi teknis dan panduan penggunaan sistem manajemen stok <span class="text-orange-600">Frozeria</span> untuk kebutuhan sertifikasi LSP.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Developer Identity -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-gradient-to-br from-orange-600 to-orange-400 rounded-[40px] p-8 shadow-2xl shadow-orange-200 relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-orange-100 uppercase tracking-[0.3em] mb-6">Peserta Sertifikasi</p>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-white tracking-tight">Muh Nu...</h3>
                            <p class="text-orange-100 text-[10px] font-bold uppercase tracking-widest opacity-80">2026-LSP-FROZ-001</p>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-white/20 flex items-center justify-between">
                        <span class="text-[10px] font-black text-white/70 uppercase tracking-widest">Status Sistem</span>
                        <span class="px-3 py-1 bg-white/20 text-white text-[9px] font-black rounded-full uppercase">Stabel (Uji)</span>
                    </div>
                </div>
            </div>

            <!-- Tech Stack -->
            <div class="bg-white rounded-[40px] border border-gray-100 p-8 shadow-xl shadow-gray-200/40">
                <h4 class="text-xs font-black text-gray-900 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    Teknologi
                </h4>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black border border-gray-100">Laravel 11</span>
                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black border border-gray-100">Tailwind CSS</span>
                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black border border-gray-100">Alpine.js</span>
                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black border border-gray-100">MySQL DB</span>
                    <span class="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black border border-gray-100">Vite Asset</span>
                </div>
            </div>
        </div>

        <!-- Main Content: Features & Guide -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-xl shadow-gray-200/40 group hover:border-orange-200 transition-all">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h5 class="text-sm font-black text-gray-900 mb-2 uppercase tracking-tight">Real-time Stock Monitor</h5>
                    <p class="text-xs text-gray-500 font-bold leading-relaxed">Dashboard interaktif dengan notifikasi stok menipis dan habis secara otomatis.</p>
                </div>
                <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-xl shadow-gray-200/40 group hover:border-orange-200 transition-all">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h5 class="text-sm font-black text-gray-900 mb-2 uppercase tracking-tight">Advanced Media Manager</h5>
                    <p class="text-xs text-gray-500 font-bold leading-relaxed">Sistem upload gambar dengan fitur Drag & Drop dan validasi ukuran file (2MB).</p>
                </div>
            </div>

            <!-- Visual Usage Guide -->
            <div class="bg-white rounded-[40px] border border-gray-100 p-8 md:p-12 shadow-xl shadow-gray-200/40">
                <h4 class="text-xs font-black text-gray-900 uppercase tracking-[0.2em] mb-10 text-center">Panduan Penggunaan Cepat</h4>
                
                <div class="space-y-12">
                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-2xl bg-orange-600 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-orange-200 flex-shrink-0 group-hover:scale-110 transition-transform">01</div>
                        <div>
                            <h6 class="text-sm font-black text-gray-900 uppercase tracking-tight mb-1">Inisialisasi Data</h6>
                            <p class="text-xs text-gray-500 font-bold leading-relaxed italic">Masuk ke menu <span class="text-gray-900">Kategori</span> untuk menentukan jenis produk sebelum mulai menambah barang baru.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-2xl bg-orange-600 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-orange-200 flex-shrink-0 group-hover:scale-110 transition-transform">02</div>
                        <div>
                            <h6 class="text-sm font-black text-gray-900 uppercase tracking-tight mb-1">Manajemen Barang</h6>
                            <p class="text-xs text-gray-500 font-bold leading-relaxed italic">Gunakan <span class="text-gray-900">Dashboard</span> untuk menambah barang. Gunakan fitur <span class="text-orange-600">Live Search</span> untuk mencari data secara instan.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-2xl bg-orange-600 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-orange-200 flex-shrink-0 group-hover:scale-110 transition-transform">03</div>
                        <div>
                            <h6 class="text-sm font-black text-gray-900 uppercase tracking-tight mb-1">Analisis Stok</h6>
                            <p class="text-xs text-gray-500 font-bold leading-relaxed italic">Klik ikon <span class="text-gray-900 text-xs">👁️ (Detail)</span> pada tabel untuk melihat informasi lengkap barang sesuai standar dokumen LSP.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
