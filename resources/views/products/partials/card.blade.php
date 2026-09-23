@php($settings ??= \App\Models\SiteSetting::current())
<div class="group relative flex flex-col rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm hover:shadow-lg transition overflow-hidden"
     x-data="{ fav: false }" x-init="fav = window.SiteStore.has('wishlist', {{ $product->id }})">
    <button type="button" @click="fav = window.SiteStore.toggle('wishlist', {{ $product->id }})"
            :aria-pressed="fav" aria-label="Simpan ke favorit"
            class="absolute top-3 right-3 z-10 inline-flex items-center justify-center h-9 w-9 rounded-full bg-white/90 dark:bg-gray-800/90 shadow hover:scale-110 transition">
        <svg class="h-5 w-5" :class="fav ? 'fill-rose-500 stroke-rose-500' : 'fill-none stroke-gray-500'" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
        </svg>
    </button>

    <a href="{{ route('products.show', $product) }}" class="flex flex-col grow">
        <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-800 overflow-hidden">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900">
                    {{ $product->type === 'service' ? '🛠️' : '📦' }}
                </div>
            @endif
        </div>
        <div class="p-5 flex flex-col grow">
            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">{{ $product->category ?? $product->type_label }}</span>
            <h3 class="mt-1 font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2">{{ $product->name }}</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 line-clamp-2 grow">{{ $product->short_description }}</p>
            <div class="mt-4 flex items-center justify-between">
                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $product->formatted_price }}</span>
                <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">Detail →</span>
            </div>
        </div>
    </a>
</div>
