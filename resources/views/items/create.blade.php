@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto pb-20 px-4" 
    x-data="{ 
        photoPreview: null, 
        isDragging: false,
        showError: false,
        errorMessage: '',
        
        // Prices with auto-formatting
        rawBuyPrice: '{{ old('buy_price', 0) }}',
        rawSellPrice: '{{ old('sell_price', 0) }}',

        // Item code validation
        item_code: '{{ old('item_code', '') }}',
        codeError: '',
        isCheckingCode: false,

        // Category selection
        category_id: '{{ old('category_id', '') }}',
        categoryName: '{{ $categories->find(old('category_id'))?->name ?? 'Pilih kategori' }}',
        showCategoryDropdown: false,
        categorySearch: '',

        formatRupiah(val) {
            if (!val) return '';
            let str = val.toString().replace(/[^0-9]/g, '');
            return str.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },

        unformatRupiah(val) {
            return val.toString().replace(/[^0-9]/g, '');
        },

        triggerError(msg) {
            this.errorMessage = msg;
            this.showError = true;
            setTimeout(() => { this.showError = false; }, 5000);
        },

        async checkCodeAvailability() {
            if (this.item_code.length < 3) {
                this.codeError = '';
                return;
            }

            this.isCheckingCode = true;
            try {
                const response = await fetch(`{{ route('items.check-code') }}?code=${this.item_code}`);
                const data = await response.json();
                
                if (data.exists) {
                    this.codeError = `Opps! Kode ini sudah digunakan oleh barang: ${data.name}`;
                } else {
                    this.codeError = '';
                }
            } catch (error) {
                console.error('Error checking code:', error);
            } finally {
                this.isCheckingCode = false;
            }
        },

        handleFile(file) {
            if (!file) return;
            if (file.size > 2 * 1024 * 1024) {
                this.triggerError('Ukuran file terlalu besar! Maksimal 2MB.');
                this.$refs.fileInput.value = '';
                this.photoPreview = null;
                return;
            }
            
            // Sync file to input if it came from drag & drop
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            this.$refs.fileInput.files = dataTransfer.files;

            const reader = new FileReader();
            reader.onload = (e) => { this.photoPreview = e.target.result; };
            reader.readAsDataURL(file);
        }
    }">

    <!-- Custom Premium Toast Alert -->
    <template x-teleport="body">
        <div x-show="showError" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="fixed top-8 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-md px-4 pointer-events-none">
            <div class="bg-white border-2 border-red-100 shadow-2xl shadow-red-200/50 rounded-[24px] p-5 flex items-center gap-4 pointer-events-auto">
                <div class="flex-shrink-0 w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="flex-grow">
                    <h4 class="text-sm font-black text-red-900 uppercase tracking-widest">Opps! Gagal</h4>
                    <p class="text-xs text-red-600/80 font-bold mt-1" x-text="errorMessage"></p>
                </div>
            </div>
        </div>
    </template>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Tambah Barang Baru</h1>
            <p class="text-gray-500 text-xs mt-0.5">Sistem Stok <span class="text-orange-600 font-bold">Frozeria</span></p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-400 hover:text-blue-600 transition-all group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Batal
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/40 overflow-hidden">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8"
            @submit="
                $refs.buyPriceInput.value = unformatRupiah(rawBuyPrice);
                $refs.sellPriceInput.value = unformatRupiah(rawSellPrice);
            ">
            @csrf
            
            <div class="space-y-8">
                <!-- Section: Media -->
                <div class="space-y-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Foto Barang</label>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-2xl border-2 border-gray-50 bg-gray-50 flex-shrink-0 overflow-hidden flex items-center justify-center relative shadow-sm transition-all duration-300"
                            :class="isDragging ? 'scale-90 border-blue-400' : ''">
                            <template x-if="!photoPreview">
                                <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
                        </div>
                        <label for="image" class="flex-grow h-24 cursor-pointer group"
                            @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                            @drop.prevent="isDragging = false; handleFile($event.dataTransfer.files[0])">
                            <div class="w-full h-full border-2 border-dashed rounded-2xl flex flex-col items-center justify-center gap-1 transition-all duration-300"
                                :class="isDragging ? 'bg-blue-100 border-blue-500' : 'bg-blue-50/20 border-blue-100 group-hover:bg-blue-50 group-hover:border-blue-400'">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    <span class="text-sm font-black text-blue-800 tracking-tight" x-text="isDragging ? 'Lepaskan foto...' : 'Klik atau Drag foto'"></span>
                                </div>
                                <span class="text-[9px] font-bold text-blue-400 uppercase tracking-widest">Maks. 2 MB</span>
                            </div>
                            <input type="file" id="image" name="image" class="hidden" accept="image/*" x-ref="fileInput" @change="handleFile($event.target.files[0])">
                        </label>
                    </div>
                </div>

                <!-- Section: Form Fields -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-blue-500 uppercase tracking-widest ml-1">Kode Barang *</label>
                            <div class="relative">
                                <input type="text" name="item_code" x-model="item_code" @input.debounce.500ms="checkCodeAvailability()" required placeholder="Contoh: FRZ-AYM-001"
                                    class="w-full px-5 py-3 bg-blue-50/20 border-2 rounded-xl focus:bg-white outline-none transition-all text-gray-900 font-bold text-sm uppercase"
                                    :class="codeError ? 'border-red-400 focus:border-red-500' : (isCheckingCode ? 'border-blue-200' : 'border-blue-50 focus:border-blue-500')">
                                
                                <div x-show="isCheckingCode" class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <svg class="animate-spin h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </div>
                            </div>
                            <p x-show="codeError" x-transition class="text-[10px] font-bold text-red-500 ml-1" x-text="codeError"></p>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Barang *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Ayam Nugget Kanzler"
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 relative" @click.away="showCategoryDropdown = false">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori *</label>
                            
                            <!-- Searchable Dropdown Button -->
                            <button @click="showCategoryDropdown = !showCategoryDropdown" type="button"
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl hover:border-orange-200 focus:bg-white focus:border-orange-500 outline-none text-gray-900 font-bold text-sm flex items-center justify-between transition-all cursor-pointer">
                                <span x-text="categoryName" :class="category_id ? 'text-gray-900' : 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" :class="showCategoryDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="category_id" x-model="category_id" required>

                            <!-- Dropdown Menu -->
                            <div x-show="showCategoryDropdown" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute z-50 mt-2 w-full bg-white border border-gray-100 rounded-2xl shadow-2xl overflow-hidden p-2">
                                
                                <div class="p-2 border-b border-gray-50 mb-2">
                                    <input type="text" x-model="categorySearch" placeholder="Cari kategori..." 
                                        class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-bold outline-none focus:ring-2 focus:ring-orange-500/20">
                                </div>

                                <div class="max-h-48 overflow-y-auto custom-scrollbar">
                                    <button type="button" @click="category_id = ''; categoryName = 'Pilih kategori'; showCategoryDropdown = false"
                                        class="w-full px-4 py-2.5 text-left text-xs font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded-lg transition-all cursor-pointer">
                                        Pilih kategori
                                    </button>
                                    @foreach($categories as $category)
                                        <button type="button" 
                                            x-show="'{{ strtolower($category->name) }}'.includes(categorySearch.toLowerCase())"
                                            @click="category_id = '{{ $category->id }}'; categoryName = '{{ $category->name }}'; showCategoryDropdown = false"
                                            class="w-full px-4 py-2.5 text-left text-xs font-bold text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-lg transition-all flex items-center justify-between group cursor-pointer">
                                            <span>{{ $category->name }}</span>
                                            <svg x-show="category_id == '{{ $category->id }}'" class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Satuan *</label>
                            <input type="text" name="unit" value="{{ old('unit') }}" required placeholder="Contoh: pack, pcs"
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-orange-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Jumlah Stok *</label>
                            <input type="number" name="stock" value="{{ old('stock', 0) }}" required 
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Stok Minimum *</label>
                            <input type="number" name="min_stock" value="{{ old('min_stock', 10) }}" required 
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                    </div>

                    <!-- Price Formatting Implementation -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-blue-500 uppercase tracking-widest ml-1">Harga Jual (Rp) *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-black text-blue-300">Rp</span>
                                <input type="text" x-model="rawSellPrice" @input="rawSellPrice = formatRupiah($event.target.value)"
                                    class="w-full pl-10 pr-5 py-3 bg-blue-50/30 border-2 border-blue-100 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-blue-900 font-black text-sm">
                                <input type="hidden" name="sell_price" x-ref="sellPriceInput">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Harga Beli (Rp) *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-300">Rp</span>
                                <input type="text" x-model="rawBuyPrice" @input="rawBuyPrice = formatRupiah($event.target.value)"
                                    class="w-full pl-10 pr-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                                <input type="hidden" name="buy_price" x-ref="buyPriceInput">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Berat / Ukuran</label>
                            <input type="text" name="weight" value="{{ old('weight') }}" placeholder="Contoh: 500 gram"
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Simpan</label>
                            <input type="text" name="storage_location" value="{{ old('storage_location') }}" placeholder="Contoh: Rak A-1"
                                class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi</label>
                        <textarea name="description" rows="2" placeholder="Tuliskan detail barang..."
                            class="w-full px-5 py-3 bg-gray-50/50 border-2 border-gray-50 rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all text-gray-900 font-bold text-sm">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                    <div class="hidden sm:flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-[10px] font-bold italic">Lengkapi data bertanda bintang (*).</p>
                    </div>
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <a href="{{ route('dashboard') }}" class="flex-1 sm:flex-none text-center px-8 py-3 border-2 border-gray-100 text-gray-400 rounded-xl font-bold text-xs hover:bg-gray-50 transition-all">Batal</a>
                        <button type="submit" class="flex-1 sm:flex-none px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-black text-xs shadow-lg shadow-blue-500/25 hover:-translate-y-0.5 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer">
                            Simpan Barang Baru
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
