<div
    x-data="gallery({{ Js::from($images) }})"
    x-init="init()"
    class="space-y-3"
>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
        <template x-for="(img, i) in images" :key="i">
            <button
                @click="open(i)"
                class="relative aspect-square overflow-hidden rounded-xl border border-surface-200 dark:border-ink-700 bg-surface-100 dark:bg-ink-800 hover:border-brand-500 dark:hover:border-brand-400 hover:shadow-md transition-all duration-300 cursor-pointer"
            >
                <img
                    :src="img.url"
                    :alt="img.alt || ''"
                    class="w-full h-full object-cover"
                    loading="lazy"
                >
            </button>
        </template>
    </div>

    <!-- Lightbox -->
    <div
        x-show="show"
        x-cloak
        @keydown.escape.window="close()"
        @keydown.left.window="prev()"
        @keydown.right.window="next()"
        class="fixed inset-0 z-[9999] bg-black/95 flex items-center justify-center"
        @click.self="close()"
    >
        <button @click="close()" class="absolute top-3 right-3 sm:top-4 sm:right-4 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white/80 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/40 text-lg sm:text-xl font-bold cursor-pointer z-10 rounded-xl transition-all duration-200">&times;</button>

        <button @click="prev()" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white/80 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/40 text-lg sm:text-xl font-bold cursor-pointer z-10 rounded-xl transition-all duration-200">&larr;</button>

        <img :src="images[current].url" :alt="images[current].alt || ''" class="max-w-[95vw] sm:max-w-[90vw] max-h-[80vh] sm:max-h-[85vh] object-contain rounded-xl border border-white/10">

        <button @click="next()" class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white/80 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/40 text-lg sm:text-xl font-bold cursor-pointer z-10 rounded-xl transition-all duration-200">&rarr;</button>

        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-xs font-mono bg-black/40 backdrop-blur-sm px-3 py-1 rounded-full">
            <span x-text="current + 1"></span> / <span x-text="images.length"></span>
        </div>
    </div>
</div>
