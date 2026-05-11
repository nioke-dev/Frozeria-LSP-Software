<div x-data="{ 
        isOpen: false, 
        imageSrc: '',
        
        openModal(detail) {
            this.imageSrc = detail.src;
            this.isOpen = true;
        }
    }"
    @open-image-modal.window="openModal($event.detail)"
    class="relative">

    <template x-teleport="body">
        <!-- Main Wrapper with Strict Centering -->
        <div x-show="isOpen"
            class="fixed inset-0 z-[99999] w-full h-full min-h-screen grid place-items-center p-6 sm:p-12 overflow-y-auto"
            x-cloak>

            <!-- Background Overlay (Fade) -->
            <div x-show="isOpen"
                x-transition:enter="transition opacity ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="isOpen = false"
                class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>

            <!-- The Modal Card (Scale + Slide Up) -->
            <div x-show="isOpen"
                x-transition:enter="transition ease-out duration-400"
                x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-8"
                class="relative bg-white w-full max-w-2xl rounded-[40px] shadow-[0_20px_70px_-10px_rgba(0,0,0,0.3)] flex flex-col overflow-hidden border border-white/20 my-auto mx-auto">

                <!-- Header -->
                <div class="flex items-center justify-between px-8 py-5 bg-white border-b border-gray-50 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Preview Foto Produk</h3>
                    </div>
                    <button @click="isOpen = false" class="p-2 text-gray-400 hover:text-orange-500 transition-all duration-300 cursor-pointer rounded-xl hover:bg-gray-50 hover:rotate-90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Body (The Image) -->
                <div class="p-8 flex justify-center bg-gray-50/30 overflow-hidden">
                    <img :src="imageSrc"
                        class="max-h-[50vh] w-auto rounded-[24px] shadow-lg border-2 border-white object-contain transition-transform duration-1000 hover:scale-[1.03]"
                        alt="Preview">
                </div>

                <!-- Footer -->
                <div class="px-8 py-6 bg-white border-t border-gray-50 flex justify-between items-center gap-4 flex-shrink-0">
                    <div class="mr-auto">
                        <p class="text-[10px] text-gray-900 font-black tracking-tight">Frozeria<span class="text-orange-500">.</span></p>
                    </div>
                    <button @click="isOpen = false" class="px-10 py-3.5 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-xl shadow-gray-200 hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                        Tutup Preview
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .fixed.inset-0 {
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
    }
</style>