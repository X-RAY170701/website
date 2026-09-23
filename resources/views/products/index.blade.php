<x-layouts.public :settings="$settings" :title="'Produk — '.$settings->site_name">

    <section class="bg-gray-50 dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Semua Produk</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Temukan produk digital & layanan yang kami tawarkan.</p>

            <form method="GET" class="mt-6 flex flex-wrap gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                       class="w-full sm:w-64 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 text-sm">

                <select name="type" onchange="this.form.submit()"
                        class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">Semua Tipe</option>
                    <option value="digital_file" @selected(request('type')==='digital_file')>Produk Digital</option>
                    <option value="service" @selected(request('type')==='service')>Jasa/Layanan</option>
                    <option value="other" @selected(request('type')==='other')>Lainnya</option>
                </select>

                <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                    Cari
                </button>

                @if(request('q') || request('type'))
                    <a href="{{ route('products.index') }}" class="rounded-lg border border-gray-300 dark:border-gray-600 px-5 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($products->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    @include('products.partials.card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-5xl mb-4">🔍</div>
                <p class="text-gray-500 dark:text-gray-400">Belum ada produk yang cocok dengan pencarian Anda.</p>
            </div>
        @endif
    </section>

</x-layouts.public>
