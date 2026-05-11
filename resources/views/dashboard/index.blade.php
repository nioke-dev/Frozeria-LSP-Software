@extends('layouts.app')

@section('content')

<div x-data="{ 
    search: '{{ request('search') }}',
    category_id: '{{ request('category_id') }}',
    categoryName: '{{ $categories->find(request('category_id'))?->name ?? 'Semua Kategori' }}',
    isLoading: false,
    showCategoryDropdown: false,
    categorySearch: '',

    async performSearch() {
        this.isLoading = true;
        const url = new URL(window.location.href);
        url.searchParams.set('search', this.search);
        url.searchParams.set('category_id', this.category_id);
        url.searchParams.set('page', 1);

        try {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            document.getElementById('items-table-body').innerHTML = doc.getElementById('items-table-body').innerHTML;
            
            const newPagination = doc.getElementById('pagination-container');
            const currentPagination = document.getElementById('pagination-container');
            if (newPagination && currentPagination) {
                currentPagination.innerHTML = newPagination.innerHTML;
            } else if (!newPagination && currentPagination) {
                currentPagination.innerHTML = '';
            }

            window.history.pushState({}, '', url);
        } catch (error) {
            console.error('Search failed:', error);
        } finally {
            this.isLoading = false;
        }
    },

    selectCategory(id, name) {
        this.category_id = id;
        this.categoryName = name;
        this.showCategoryDropdown = false;
        this.performSearch();
    }
}" @click.away="showCategoryDropdown = false">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12 px-2">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Dashboard Barang</h1>
            <p class="text-gray-500 text-sm font-bold">Monitor stok makanan beku <span class="text-orange-600 font-black italic">Frozeria</span></p>
        </div>
        <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-xs font-black text-white bg-orange-600 rounded-2xl hover:bg-orange-700 transition-all shadow-xl shadow-orange-100 hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Barang
        </a>
    </div>

    <!-- Stats Grid (4 Columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Total Barang -->
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 flex items-center space-x-5 group hover:border-orange-200 transition-all">
            <div class="p-4 bg-blue-50 text-blue-600 rounded-[22px] shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-1">Total Barang</p>
                <h3 class="text-2xl font-black text-gray-900 tracking-tight">{{ $total_items }}</h3>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 flex items-center space-x-5 group hover:border-orange-200 transition-all">
            <div class="p-4 bg-purple-50 text-purple-600 rounded-[22px] shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </div>
            <div>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-1">Total Kategori</p>
                <h3 class="text-2xl font-black text-gray-900 tracking-tight">{{ $total_categories }}</h3>
            </div>
        </div>

        <!-- Stok Menipis -->
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 flex items-center space-x-5 group hover:border-orange-200 transition-all">
            <div class="p-4 bg-amber-50 text-amber-600 rounded-[22px] shadow-inner animate-pulse">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-1">Stok Menipis</p>
                <h3 class="text-2xl font-black text-gray-900 tracking-tight">{{ $low_stock_items }}</h3>
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 flex items-center space-x-5 group hover:border-orange-200 transition-all">
            <div class="p-4 bg-red-50 text-red-600 rounded-[22px] shadow-inner font-black text-xl italic">X</div>
            <div>
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-1">Stok Habis</p>
                <h3 class="text-2xl font-black text-gray-900 tracking-tight">{{ $out_of_stock_items }}</h3>
            </div>
        </div>
    </div>

    <!-- Enhanced Searchable Filter Area -->
    <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 mb-10">
        <div class="flex flex-col md:flex-row gap-4 items-center w-full">
            <!-- Search Input -->
            <div class="w-full md:flex-grow relative">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none text-gray-300">
                    <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <svg x-show="isLoading" class="animate-spin h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
                <input type="text" x-model="search" @input.debounce.500ms="performSearch()" placeholder="Cari nama barang..." 
                    class="w-full h-14 pl-14 pr-6 bg-gray-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all text-sm font-bold text-gray-700 placeholder:text-gray-300">
            </div>

            <!-- Searchable Category Dropdown -->
            <div class="w-full md:w-72 relative">
                <button @click="showCategoryDropdown = !showCategoryDropdown" type="button"
                    class="w-full h-14 px-6 bg-gray-50 border-2 border-transparent hover:border-orange-200 focus:border-orange-500 rounded-2xl outline-none text-sm font-bold text-gray-700 flex items-center justify-between transition-all cursor-pointer">
                    <span x-text="categoryName"></span>
                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="showCategoryDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="showCategoryDropdown" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute z-50 mt-3 w-full bg-white border border-gray-100 rounded-[24px] shadow-2xl overflow-hidden p-2">
                    
                    <!-- Search inside dropdown -->
                    <div class="p-2 mb-2">
                        <input type="text" x-model="categorySearch" placeholder="Cari kategori..." 
                            class="w-full h-10 px-4 bg-gray-50 border-2 border-transparent focus:border-orange-500 rounded-xl outline-none text-xs font-bold text-gray-600 placeholder:text-gray-300">
                    </div>

                    <!-- Options List -->
                    <div class="max-h-60 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-100">
                        <button @click="selectCategory('', 'Semua Kategori')" 
                            class="w-full px-4 py-3 text-left text-xs font-bold text-gray-500 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all cursor-pointer">
                            Semua Kategori
                        </button>
                        @foreach($categories as $cat)
                        <template x-if="'{{ $cat->name }}'.toLowerCase().includes(categorySearch.toLowerCase())">
                            <button @click="selectCategory('{{ $cat->id }}', '{{ $cat->name }}')" 
                                class="w-full px-4 py-3 text-left text-xs font-bold text-gray-700 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all flex items-center justify-between cursor-pointer">
                                <span>{{ $cat->name }}</span>
                                <svg x-show="category == '{{ $cat->id }}'" class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </template>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-2xl shadow-gray-200/50 overflow-hidden mb-20 relative">
        <div x-show="isLoading" x-transition class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center"></div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    <tr><th class="px-8 py-5">Nama Barang</th><th class="px-8 py-5 text-center">Kategori</th><th class="px-8 py-5 text-center">Stok</th><th class="px-8 py-5">Harga</th><th class="px-8 py-5 text-center">Opsi</th></tr>
                </thead>
                <tbody id="items-table-body" class="divide-y divide-gray-50">
                    @forelse($items as $item)
                    <tr class="hover:bg-gray-50/30 transition-colors">
                        <td class="px-8 py-6 font-black text-gray-900 text-sm tracking-tight">{{ $item->name }}</td>
                        <td class="px-8 py-6 text-center"><span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-[9px] font-black uppercase tracking-widest">{{ $item->category->name }}</span></td>
                        <td class="px-6 py-6 whitespace-nowrap text-center">
                        @if($item->stock <= 0)
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-[10px] font-black text-red-600 bg-red-50 px-3 py-1 rounded-full uppercase tracking-widest animate-pulse flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    Habis
                                </span>
                            </div>
                        @elseif($item->stock < $item->min_stock)
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-black text-orange-600 flex items-center gap-1.5">
                                    {{ $item->stock }}
                                    <span class="text-[10px] font-bold text-gray-400 lowercase">{{ $item->unit }}</span>
                                    <svg class="w-4 h-4 text-orange-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                </span>
                            </div>
                        @else
                            <span class="text-sm font-black text-gray-900 italic">
                                {{ $item->stock }} 
                                <span class="text-[10px] font-bold text-gray-400 lowercase">{{ $item->unit }}</span>
                            </span>
                        @endif
                    </td>
                        <td class="px-8 py-6 font-black text-gray-900 text-sm tracking-tight">Rp{{ number_format($item->sell_price, 0, ',', '.') }}</td>
                        <td class="px-8 py-6"><div class="flex items-center justify-center gap-2">
                            <a href="{{ route('items.show', $item->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                            <a href="{{ route('items.edit', $item->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-xl transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                            <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('items.destroy', $item->id) }}', name: '{{ $item->name }}' })" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-8 py-20 text-center text-gray-400 font-bold italic">Barang tidak ditemukan...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="pagination-container">
            @if($items->hasPages())
            <div class="px-8 py-8 border-t border-gray-50 bg-gray-50/20 flex flex-col sm:flex-row items-center justify-between gap-6">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                    Baris <span class="text-gray-900">{{ $items->firstItem() }}</span> - <span class="text-gray-900">{{ $items->lastItem() }}</span> dari <span class="text-gray-900">{{ $items->total() }}</span> unit
                </p>
                <div class="pagination-ultra">
                    {{ $items->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Ultra Pagination Override */
    .pagination-ultra nav div:first-child { display: none !important; }
    .pagination-ultra nav div:last-child { border: none !important; box-shadow: none !important; background: transparent !important; padding: 0 !important; margin: 0 !important; }
    .pagination-ultra nav { display: flex !important; gap: 0 !important; border: none !important; background: transparent !important; box-shadow: none !important; padding: 0 !important; }
    .pagination-ultra .relative.z-0 { display: none !important; }
    
    /* Reset all nested containers that might have shadows */
    .pagination-ultra nav span, 
    .pagination-ultra nav div { 
        box-shadow: none !important; 
        border: none !important; 
        background: transparent !important;
    }

    .pagination-ultra a, .pagination-ultra span[aria-current="page"] > span, .pagination-ultra span[aria-disabled="true"] > span {
        display: inline-flex !important; align-items: center !important; justify-content: center !important; min-width: 42px !important; height: 42px !important; margin: 0 4px !important; font-size: 11px !important; font-weight: 900 !important; border-radius: 14px !important; border: 2px solid #F3F4F6 !important; background: white !important; color: #4B5563 !important; transition: all 0.2s ease !important; text-decoration: none !important;
    }
    .pagination-ultra a:hover { background: #FFF7ED !important; border-color: #EA580C !important; color: #EA580C !important; transform: translateY(-3px) !important; }
    .pagination-ultra span[aria-current="page"] > span { background: #EA580C !important; border-color: #EA580C !important; color: white !important; box-shadow: 0 10px 20px rgba(234, 88, 12, 0.2) !important; }
    .pagination-ultra svg { width: 16px !important; height: 16px !important; stroke-width: 3 !important; }
</style>

@include('components.delete-modal')
@endsection
