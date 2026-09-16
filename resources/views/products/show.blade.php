<x-layouts.public :settings="$settings" :title="$product->name.' — '.$settings->site_name">

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-[4/3]">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-indigo-100 to-purple-100">
                        {{ $product->type === 'service' ? '🛠️' : '📦' }}
                    </div>
                @endif
            </div>

            <div>
                <span class="inline-block text-xs font-semibold text-indigo-600 uppercase tracking-wide bg-indigo-50 rounded-full px-3 py-1">
                    {{ $product->category ?? $product->type_label }}
                </span>
                <h1 class="mt-4 text-3xl font-extrabold text-gray-900">{{ $product->name }}</h1>
                <p class="mt-3 text-gray-500">{{ $product->short_description }}</p>

                <div class="mt-6 text-3xl font-bold text-gray-900">{{ $product->formatted_price }}</div>

                <div class="mt-8 flex flex-wrap gap-4">
                    @php
                        $waMessage = rawurlencode("Halo, saya tertarik dengan produk \"{$product->name}\" di {$settings->site_name}. Bisa dibantu info lebih lanjut?");
                        $waLink = $settings->whatsapp_link.'?text='.$waMessage;
                    @endphp
                    <a href="{{ $waLink }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white hover:bg-indigo-500 transition shadow-lg shadow-indigo-200">
                        {{ $product->cta_label }}
                    </a>
                    @if($product->external_link)
                        <a href="{{ $product->external_link }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-50 transition">
                            Lihat Detail/Demo
                        </a>
                    @endif
                </div>

                @if($product->description)
                    <div class="mt-10 prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Deskripsi Produk</h2>
                        {{ $product->description }}
                    </div>
                @endif
            </div>
        </div>

        @if($related->count())
            <div class="mt-20">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($related as $item)
                        @include('products.partials.card', ['product' => $item])
                    @endforeach
                </div>
            </div>
        @endif
    </section>

</x-layouts.public>
