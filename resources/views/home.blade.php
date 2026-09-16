<x-layouts.public :settings="$settings">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-indigo-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 mb-5">
                    {{ $settings->tagline }}
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 leading-tight">
                    {{ $settings->hero_title }}
                </h1>
                <p class="mt-6 text-lg text-gray-600">
                    {{ $settings->hero_subtitle }}
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white hover:bg-indigo-500 transition shadow-lg shadow-indigo-200">
                        Lihat Produk
                    </a>
                    <a href="{{ $settings->whatsapp_link }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Chat WhatsApp
                    </a>
                </div>
            </div>
            <div class="relative">
                @if($settings->hero_image_url)
                    <img src="{{ $settings->hero_image_url }}" alt="{{ $settings->site_name }}" class="rounded-2xl shadow-2xl w-full object-cover">
                @else
                    <div class="aspect-[4/3] rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-2xl flex items-center justify-center text-white text-center p-8">
                        <div>
                            <div class="text-5xl mb-3">✨</div>
                            <p class="font-semibold">Ganti gambar ini lewat Pengaturan Situs di panel admin</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Trust bar / value props --}}
    <section class="border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid sm:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-3xl mb-2">⚡</div>
                <div class="font-semibold text-gray-900">Proses Cepat</div>
                <p class="text-sm text-gray-500 mt-1">Pemesanan dan respon cepat lewat WhatsApp.</p>
            </div>
            <div>
                <div class="text-3xl mb-2">🔒</div>
                <div class="font-semibold text-gray-900">Terpercaya</div>
                <p class="text-sm text-gray-500 mt-1">Kualitas produk terjamin dan konsisten.</p>
            </div>
            <div>
                <div class="text-3xl mb-2">💬</div>
                <div class="font-semibold text-gray-900">Layanan Ramah</div>
                <p class="text-sm text-gray-500 mt-1">Konsultasi kebutuhan Anda sebelum membeli.</p>
            </div>
        </div>
    </section>

    {{-- Featured products --}}
    @if($featuredProducts->count())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Produk Unggulan</h2>
                <p class="text-gray-500 mt-1">Pilihan terbaik dari kami untuk Anda.</p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline text-indigo-600 font-semibold hover:text-indigo-500">Lihat semua →</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProducts as $product)
                @include('products.partials.card', ['product' => $product])
            @endforeach
        </div>
    </section>
    @endif

    {{-- All / latest products --}}
    @if($latestProducts->count())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Produk Lainnya</h2>
                <a href="{{ route('products.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-500">Lihat semua →</a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProducts->take(4) as $product)
                    @include('products.partials.card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- About --}}
    <section id="tentang" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Tentang {{ $settings->site_name }}</h2>
        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $settings->about_text }}</p>
    </section>

    {{-- CTA --}}
    <section class="bg-indigo-600">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Siap memulai?</h2>
            <p class="text-indigo-100 mb-8">Hubungi kami sekarang untuk konsultasi atau pemesanan produk digital Anda.</p>
            <a href="{{ $settings->whatsapp_link }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 font-semibold text-indigo-600 hover:bg-indigo-50 transition">
                Chat via WhatsApp
            </a>
        </div>
    </section>

</x-layouts.public>
