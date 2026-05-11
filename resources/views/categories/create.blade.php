@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto pb-20 px-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Kategori</h1>
            <p class="text-gray-500 text-sm font-bold mt-1">Buat pengelompokan barang baru untuk <span class="text-orange-600 font-black italic">Frozeria</span></p>
        </div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1.5 text-xs font-black text-gray-400 hover:text-orange-600 transition-all group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Batal
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-2xl shadow-gray-200/40 overflow-hidden">
        <form action="{{ route('categories.store') }}" method="POST" class="p-8 md:p-12 space-y-10">
            @csrf
            
            <div class="space-y-8">
                <!-- Nama Kategori -->
                <div class="space-y-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Nama Kategori *</label>
                    <div class="relative group">
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full h-16 px-6 bg-gray-50/50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all text-gray-900 font-black text-lg placeholder:text-gray-300 shadow-sm"
                            placeholder="Contoh: Frozen Food, Minuman, Snack...">
                    </div>
                    @error('name')
                        <p class="text-[10px] text-red-500 font-black uppercase tracking-widest mt-2 ml-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="space-y-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Deskripsi Kategori</label>
                    <div class="relative group">
                        <textarea name="description" rows="5" 
                            class="w-full px-6 py-5 bg-gray-50/50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-3xl outline-none transition-all text-gray-700 font-bold text-sm placeholder:text-gray-300 shadow-sm"
                            placeholder="Tuliskan deskripsi singkat kategori di sini...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-10 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2 text-gray-400">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-[10px] font-black italic tracking-wider">Tanda bintang (*) berarti data wajib diisi.</p>
                </div>
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <a href="{{ route('categories.index') }}" class="flex-1 sm:flex-none text-center px-10 py-4 border-2 border-gray-100 text-gray-400 rounded-2xl font-black text-xs hover:bg-gray-50 transition-all uppercase tracking-widest">Batal</a>
                    <button type="submit" class="flex-1 sm:flex-none px-12 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl font-black text-xs shadow-xl shadow-orange-500/25 hover:-translate-y-1 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 uppercase tracking-widest cursor-pointer">
                        Simpan Kategori
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
