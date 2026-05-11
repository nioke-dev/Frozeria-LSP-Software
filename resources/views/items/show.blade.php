@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto pb-20 px-4" x-data="{}">
    <!-- Header: Consistent with LSP -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-500 hover:bg-gray-50 transition-all">
                ‹ Kembali
            </a>
            <h1 class="text-xl font-bold text-gray-900">Detail Barang</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('items.edit', $item->id) }}" class="px-5 py-2 bg-white border border-blue-200 rounded-lg text-sm font-bold text-blue-600 hover:bg-blue-50 transition-all">Edit Barang</a>
            <button @click="$dispatch('open-delete-modal', { url: '{{ route('items.destroy', $item->id) }}', name: '{{ $item->name }}', type: 'barang' })"
                class="px-5 py-2 bg-white border border-red-200 rounded-lg text-sm font-bold text-red-600 hover:bg-red-50 transition-all cursor-pointer">Hapus</button>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-2xl shadow-gray-200/50 p-6 md:p-10 space-y-8">
        <!-- Top Section: Image and Name -->
        <div class="flex flex-col md:flex-row gap-12 items-center md:items-start text-center md:text-left">
            <div class="w-64 h-64 md:w-72 md:h-72 rounded-[40px] bg-gray-50 border-4 border-white shadow-2xl shadow-gray-200 flex-shrink-0 overflow-hidden flex items-center justify-center group hover:scale-[1.02] transition-all duration-500">
                @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}"
                    @click="$dispatch('open-image-modal', { src: '{{ asset('storage/' . $item->image_path) }}' })"
                    class="w-full cursor-pointer h-full object-cover cursor-zoom-in transition-transform duration-500 group-hover:scale-110"
                    alt="{{ $item->name }}">
                @else
                <div class="flex flex-col items-center gap-4">
                    <svg class="w-24 h-24 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Belum ada foto</span>
                </div>
                @endif
            </div>
            <div class="space-y-6 pt-4">
                <div class="space-y-2">
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] ml-1">Nama Produk</p>
                    <h2 class="text-4xl font-black text-gray-900 tracking-tight leading-tight">{{ $item->name }}</h2>
                </div>
                <div class="inline-flex items-center gap-2 px-6 py-2 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest">
                    <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                    {{ $item->category->name }}
                </div>
            </div>
        </div>

        <!-- Grid Info: Strictly Matching LSP Fields -->
        <div class="space-y-4">
            <!-- Row 1: Stock Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Jumlah stok</label>
                    <p class="text-lg font-black text-gray-900">{{ $item->stock }} {{ $item->unit }}</p>
                </div>
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Stok minimum</label>
                    <p class="text-lg font-black text-gray-900">{{ $item->min_stock }} {{ $item->unit }}</p>
                </div>
            </div>

            <!-- Row 2: Price Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Harga jual</label>
                    <p class="text-lg font-black text-gray-900 tracking-tight">Rp {{ number_format($item->sell_price, 0, ',', '.') }}</p>
                </div>
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Harga beli</label>
                    <p class="text-lg font-black text-gray-900 tracking-tight">Rp {{ number_format($item->buy_price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Row 3: Detail Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Berat / ukuran</label>
                    <p class="text-lg font-black text-gray-900">{{ $item->weight ?: '-' }}</p>
                </div>
                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Lokasi simpan</label>
                    <p class="text-lg font-black text-gray-900 uppercase tracking-tight">{{ $item->storage_location ?: '-' }}</p>
                </div>
            </div>

            <!-- Row 4: Description -->
            <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                <p class="text-sm font-bold text-gray-500 leading-relaxed">{{ $item->description ?: 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
    </div>
</div>

@include('components.delete-modal')
@include('components.image-modal')
@endsection