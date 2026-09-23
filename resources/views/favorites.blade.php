@php($settings = \App\Models\SiteSetting::current())
<x-layouts.public :settings="$settings" :title="'Favorit — '.$settings->site_name">

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
             x-data="{ items: [], loaded: false }"
             x-init="
                 fetch('{{ route('api.products.lookup') }}?ids=' + window.SiteStore.list('wishlist').join(','))
                     .then(r => r.json()).then(res => { items = res.data; loaded = true; })
             ">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 flex items-center gap-3">
            <svg class="h-8 w-8 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" /></svg>
            Produk Favorit Saya
        </h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Daftar produk yang kamu simpan di perangkat ini.</p>

        <div class="mt-10" x-show="loaded && items.length" x-cloak>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="item in items" :key="item.id">
                    <div class="group relative flex flex-col rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm hover:shadow-lg transition overflow-hidden">
                        <button type="button" @click="window.SiteStore.toggle('wishlist', item.id); items = items.filter(i => i.id !== item.id)"
                                aria-label="Hapus dari favorit"
                                class="absolute top-3 right-3 z-10 inline-flex items-center justify-center h-9 w-9 rounded-full bg-white/90 dark:bg-gray-800/90 shadow hover:scale-110 transition">
                            <svg class="h-5 w-5 fill-rose-500 stroke-rose-500" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                            </svg>
                        </button>
                        <a :href="item.url" class="flex flex-col grow">
                            <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-800 overflow-hidden">
                                <img :src="item.image_url" x-show="item.image_url" class="w-full h-full object-cover" :alt="item.name">
                            </div>
                            <div class="p-5">
                                <div class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase" x-text="item.category"></div>
                                <div class="mt-1 font-semibold text-gray-900 dark:text-gray-100 line-clamp-2" x-text="item.name"></div>
                                <div class="mt-2 font-bold text-gray-900 dark:text-gray-100" x-text="item.price"></div>
                            </div>
                        </a>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="loaded && !items.length" x-cloak class="text-center py-20">
            <div class="text-5xl mb-4">🤍</div>
            <p class="text-gray-500 dark:text-gray-400">Belum ada produk favorit. Klik ikon hati pada produk untuk menyimpannya di sini.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-6 text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-500">Lihat Produk →</a>
        </div>
    </section>

</x-layouts.public>
