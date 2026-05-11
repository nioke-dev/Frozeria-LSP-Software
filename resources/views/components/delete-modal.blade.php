<div x-data="{ 
        isOpen: false, 
        deleteUrl: '', 
        itemName: '',
        
        openModal(detail) {
            this.deleteUrl = detail.url;
            this.itemName = detail.name;
            this.isOpen = true;
        }
    }"
    @open-delete-modal.window="openModal($event.detail)"
    class="relative">
    
    <template x-teleport="body">
        <div x-show="isOpen" 
             class="fixed inset-0 z-[99999] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
             x-cloak>
            
            <!-- Backdrop with Blur -->
            <div x-show="isOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="isOpen = false"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div x-show="isOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-md bg-white rounded-[32px] shadow-2xl border border-gray-100 overflow-hidden">
                
                <div class="p-8 text-center">
                    <!-- Danger Icon -->
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-red-50 text-red-600 mb-6">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-gray-900 mb-2">Konfirmasi Hapus</h3>
                    <p class="text-sm font-bold text-gray-500 mb-8 leading-relaxed px-4 italic">
                        "Apakah Anda yakin ingin menghapus <span class="text-red-600 not-italic font-black" x-text="itemName"></span> secara permanen dari sistem?"
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button @click="isOpen = false" 
                            class="flex-1 px-6 py-4 text-xs font-black text-gray-400 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-all uppercase tracking-widest cursor-pointer">
                            Batal
                        </button>
                        <form :action="deleteUrl" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="w-full px-6 py-4 text-xs font-black text-white bg-red-600 rounded-2xl hover:bg-red-700 shadow-lg shadow-red-200 transition-all active:scale-95 uppercase tracking-widest cursor-pointer">
                                Hapus Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
