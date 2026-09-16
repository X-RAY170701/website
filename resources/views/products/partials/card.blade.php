@php($settings ??= \App\Models\SiteSetting::current())
<a href="{{ route('products.show', $product) }}" class="group flex flex-col rounded-xl border border-gray-100 bg-white shadow-sm hover:shadow-lg transition overflow-hidden">
    <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-indigo-100 to-purple-100">
                {{ $product->type === 'service' ? '🛠️' : '📦' }}
            </div>
        @endif
    </div>
    <div class="p-5 flex flex-col grow">
        <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">{{ $product->category ?? $product->type_label }}</span>
        <h3 class="mt-1 font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">{{ $product->name }}</h3>
        <p class="mt-2 text-sm text-gray-500 line-clamp-2 grow">{{ $product->short_description }}</p>
        <div class="mt-4 flex items-center justify-between">
            <span class="font-bold text-gray-900">{{ $product->formatted_price }}</span>
            <span class="text-sm font-semibold text-indigo-600">Detail →</span>
        </div>
    </div>
</a>
