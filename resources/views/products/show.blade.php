<x-layouts.public :settings="$settings" :title="$product->name.' — '.$settings->site_name">

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 dark:text-gray-200">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            <div class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 aspect-[4/3]">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900">
                        {{ $product->type === 'service' ? '🛠️' : '📦' }}
                    </div>
                @endif
            </div>

            <div x-data="{ fav: false }" x-init="fav = window.SiteStore.has('wishlist', {{ $product->id }}); window.SiteStore.addRecent('recently_viewed', {{ $product->id }}, 8)">
                <div class="flex items-center justify-between gap-4">
                    <span class="inline-block text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide bg-indigo-50 dark:bg-indigo-950 rounded-full px-3 py-1">
                        {{ $product->category ?? $product->type_label }}
                    </span>
                    <div class="flex items-center gap-1 text-xs text-gray-400 dark:text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ number_format($product->views_count) }}x dilihat
                    </div>
                </div>

                <h1 class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-gray-100">{{ $product->name }}</h1>
                <p class="mt-3 text-gray-500 dark:text-gray-400">{{ $product->short_description }}</p>

                <div class="mt-6 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $product->formatted_price }}</div>

                <div class="mt-8 flex flex-wrap gap-3 items-center">
                    @php
                        $waMessage = rawurlencode("Halo, saya tertarik dengan produk \"{$product->name}\" di {$settings->site_name}. Bisa dibantu info lebih lanjut?");
                        $waLink = $settings->whatsapp_link.'?text='.$waMessage;
                    @endphp
                    <a href="{{ $waLink }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white hover:bg-indigo-500 transition shadow-lg shadow-indigo-200 dark:shadow-none">
                        {{ $product->cta_label }}
                    </a>
                    @if($product->external_link)
                        <a href="{{ $product->external_link }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 px-6 py-3 font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            Lihat Detail/Demo
                        </a>
                    @endif
                    <button type="button" @click="fav = window.SiteStore.toggle('wishlist', {{ $product->id }})"
                            class="inline-flex items-center justify-center h-12 w-12 rounded-lg border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                            aria-label="Simpan ke favorit">
                        <svg class="h-5 w-5" :class="fav ? 'fill-rose-500 stroke-rose-500' : 'fill-none stroke-gray-500 dark:stroke-gray-300'" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                        </svg>
                    </button>
                </div>

                {{-- Bagikan produk --}}
                @php
                    $shareUrl = rawurlencode(url()->current());
                    $shareText = rawurlencode($product->name.' — '.$settings->site_name);
                @endphp
                <div class="mt-6 flex items-center gap-3">
                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Bagikan:</span>
                    <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp"
                       class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-green-50 dark:bg-green-950 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900 transition">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.85.505 3.583 1.385 5.077L2 22l5.077-1.36A9.953 9.953 0 0 0 12.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.06a8.03 8.03 0 0 1-4.098-1.126l-.294-.175-3.017.808.806-2.943-.192-.303A8.03 8.03 0 0 1 3.94 12c0-4.444 3.616-8.06 8.061-8.06 4.444 0 8.06 3.616 8.06 8.06 0 4.444-3.616 8.06-8.06 8.06z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook"
                       class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 transition">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Bagikan ke X/Twitter"
                       class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <button type="button" onclick="navigator.clipboard.writeText(window.location.href); this.dataset.copied = 'true'; setTimeout(() => this.dataset.copied = 'false', 1500)"
                            aria-label="Salin link" data-copied="false"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition relative">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-4 4a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l4-4a4 4 0 015.656 5.656l-1.5 1.5" /></svg>
                    </button>
                </div>

                @if($product->description)
                    <div class="mt-10 prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-line">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Deskripsi Produk</h2>
                        {{ $product->description }}
                    </div>
                @endif
            </div>
        </div>

        @if($related->count())
            <div class="mt-20">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Produk Terkait</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($related as $item)
                        @include('products.partials.card', ['product' => $item])
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Produk yang baru dilihat (localStorage, dirender via JS) --}}
        <div x-data="{ items: [] }" x-init="
                fetch('{{ route('api.products.lookup') }}?ids=' + window.SiteStore.list('recently_viewed').filter(id => id !== {{ $product->id }}).join(','))
                    .then(r => r.json()).then(res => items = res.data)
            " x-show="items.length" x-cloak class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Baru Saja Dilihat</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="item in items" :key="item.id">
                    <a :href="item.url" class="flex flex-col rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm hover:shadow-lg transition overflow-hidden">
                        <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <img :src="item.image_url" x-show="item.image_url" class="w-full h-full object-cover" :alt="item.name">
                        </div>
                        <div class="p-4">
                            <div class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase" x-text="item.category"></div>
                            <div class="mt-1 font-semibold text-gray-900 dark:text-gray-100 text-sm line-clamp-2" x-text="item.name"></div>
                            <div class="mt-2 font-bold text-gray-900 dark:text-gray-100 text-sm" x-text="item.price"></div>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>

</x-layouts.public>
