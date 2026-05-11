@extends('layouts.app')

@section('content')

<div x-data="{ 
    search: '{{ request('search') }}',
    isLoading: false,

    async performSearch() {
        this.isLoading = true;
        const url = new URL(window.location.href);
        url.searchParams.set('search', this.search);
        url.searchParams.set('page', 1);

        try {
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            document.getElementById('categories-table-body').innerHTML = doc.getElementById('categories-table-body').innerHTML;
            
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
    }
}">
    <!-- Header & Action -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12 px-2">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Manajemen Kategori</h1>
            <p class="text-gray-500 text-sm font-bold">Kelola pengelompokan barang <span class="text-orange-600 font-black italic">Frozeria</span></p>
        </div>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-xs font-black text-white bg-orange-600 rounded-2xl hover:bg-orange-700 transition-all shadow-xl shadow-orange-100 hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </a>
    </div>

    <!-- Live Search Filter Area -->
    <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-xl shadow-gray-200/30 mb-10">
        <div class="relative group">
            <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none text-gray-300">
                <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <svg x-show="isLoading" class="animate-spin h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <input type="text" x-model="search" @input.debounce.500ms="performSearch()" placeholder="Cari nama kategori secara real-time..."
                class="w-full h-14 pl-14 pr-6 bg-gray-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all text-sm font-bold text-gray-700 placeholder:text-gray-300">
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[40px] border border-gray-100 shadow-2xl shadow-gray-200/50 overflow-hidden mb-20 relative">
        <!-- Loading Overlay -->
        <div x-show="isLoading" x-transition class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Nama Kategori</th>
                        <th class="px-8 py-5">Deskripsi</th>
                        <th class="px-8 py-5 text-center">Total Barang</th>
                        <th class="px-8 py-5 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody id="categories-table-body" class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/30 transition-colors">
                        <td class="px-8 py-6">
                            <span class="text-sm font-black text-gray-900 uppercase tracking-tight">
                                {{ $category->name }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-medium text-gray-500 line-clamp-1 italic">{{ $category->description ?: 'Tidak ada deskripsi.' }}</p>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-4 py-2 bg-orange-50 text-orange-700 rounded-xl text-xs font-black uppercase tracking-widest border border-orange-100">
                                {{ $category->items_count }} <span class="text-[9px] text-orange-400 ml-1">Unit</span>
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="p-2.5 text-amber-500 hover:bg-amber-50 rounded-xl transition-all" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('categories.destroy', $category->id) }}', name: '{{ $category->name }}' })"
                                    class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-all cursor-pointer" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-400 font-bold italic">Kategori tidak ditemukan...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination Footer -->
        <div id="pagination-container">
            @if($categories->hasPages())
            <div class="px-8 py-8 border-t border-gray-50 bg-gray-50/20 flex flex-col sm:flex-row items-center justify-between gap-6">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                    Baris <span class="text-gray-900">{{ $categories->firstItem() }}</span> - <span class="text-gray-900">{{ $categories->lastItem() }}</span> dari <span class="text-gray-900">{{ $categories->total() }}</span> unit
                </p>
                <div class="pagination-ultra">
                    {{ $categories->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Ultra Pagination Override */
    .pagination-ultra nav div:first-child {
        display: none !important;
    }

    .pagination-ultra nav div:last-child {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .pagination-ultra nav {
        display: flex !important;
        gap: 0 !important;
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .pagination-ultra .relative.z-0 {
        display: none !important;
    }

    /* Reset all nested containers that might have shadows */
    .pagination-ultra nav span,
    .pagination-ultra nav div {
        box-shadow: none !important;
        border: none !important;
        background: transparent !important;
    }

    .pagination-ultra a,
    .pagination-ultra span[aria-current="page"]>span,
    .pagination-ultra span[aria-disabled="true"]>span {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 42px !important;
        height: 42px !important;
        margin: 0 4px !important;
        font-size: 11px !important;
        font-weight: 900 !important;
        border-radius: 14px !important;
        border: 2px solid #F3F4F6 !important;
        background: white !important;
        color: #4B5563 !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
    }

    .pagination-ultra a:hover {
        background: #FFF7ED !important;
        border-color: #EA580C !important;
        color: #EA580C !important;
        transform: translateY(-3px) !important;
    }

    .pagination-ultra span[aria-current="page"]>span {
        background: #EA580C !important;
        border-color: #EA580C !important;
        color: white !important;
        box-shadow: 0 10px 20px rgba(234, 88, 12, 0.2) !important;
    }

    .pagination-ultra svg {
        width: 16px !important;
        height: 16px !important;
        stroke-width: 3 !important;
    }
</style>

@include('components.delete-modal')
@endsection