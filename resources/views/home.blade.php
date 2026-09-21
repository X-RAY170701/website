<x-layouts.public :settings="$settings">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-indigo-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
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
            <div class="relative" data-aos="fade-left">
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

    {{-- Statistik pencapaian --}}
    <section class="bg-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">
            <div data-aos="fade-up" data-aos-delay="0">
                <div class="text-3xl sm:text-4xl font-extrabold text-white">{{ $settings->stat_customers ?? '500+' }}</div>
                <div class="text-sm text-indigo-200 mt-1">Pelanggan Puas</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl sm:text-4xl font-extrabold text-white">{{ $settings->stat_products ?? '50+' }}</div>
                <div class="text-sm text-indigo-200 mt-1">Produk Tersedia</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl sm:text-4xl font-extrabold text-white">{{ $settings->stat_experience ?? '3+' }}</div>
                <div class="text-sm text-indigo-200 mt-1">Tahun Pengalaman</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-3xl sm:text-4xl font-extrabold text-white">{{ $settings->stat_satisfaction ?? '98%' }}</div>
                <div class="text-sm text-indigo-200 mt-1">Tingkat Kepuasan</div>
            </div>
        </div>
    </section>

    {{-- Trust bar / value props --}}
    <section class="border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid sm:grid-cols-3 gap-8 text-center">
            <div data-aos="fade-up">
                <div class="text-3xl mb-2">⚡</div>
                <div class="font-semibold text-gray-900">Proses Cepat</div>
                <p class="text-sm text-gray-500 mt-1">Pemesanan dan respon cepat lewat WhatsApp.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl mb-2">🔒</div>
                <div class="font-semibold text-gray-900">Terpercaya</div>
                <p class="text-sm text-gray-500 mt-1">Kualitas produk terjamin dan konsisten.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl mb-2">💬</div>
                <div class="font-semibold text-gray-900">Layanan Ramah</div>
                <p class="text-sm text-gray-500 mt-1">Konsultasi kebutuhan Anda sebelum membeli.</p>
            </div>
        </div>
    </section>

    {{-- Featured products --}}
    @if($featuredProducts->count())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-8" data-aos="fade-up">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Produk Unggulan</h2>
                <p class="text-gray-500 mt-1">Pilihan terbaik dari kami untuk Anda.</p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline text-indigo-600 font-semibold hover:text-indigo-500">Lihat semua →</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProducts as $i => $product)
                <div data-aos="fade-up" data-aos-delay="{{ min($i, 3) * 100 }}">
                    @include('products.partials.card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- All / latest products --}}
    @if($latestProducts->count())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Produk Lainnya</h2>
                <a href="{{ route('products.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-500">Lihat semua →</a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProducts->take(4) as $i => $product)
                    <div data-aos="fade-up" data-aos-delay="{{ min($i, 3) * 100 }}">
                        @include('products.partials.card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- About --}}
    <section id="tentang" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center" data-aos="fade-up">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Tentang {{ $settings->site_name }}</h2>
        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $settings->about_text }}</p>
    </section>

    {{-- Testimoni --}}
    @if($testimonials->count())
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Apa Kata Mereka</h2>
                <p class="text-gray-500 mt-2">Pengalaman nyata dari pelanggan kami.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $i => $t)
                    <div class="rounded-xl bg-white border border-gray-100 shadow-sm p-6 flex flex-col"
                         data-aos="fade-up" data-aos-delay="{{ min($i, 3) * 100 }}">
                        <div class="flex items-center gap-1 text-amber-400 mb-3">
                            @for($s = 1; $s <= 5; $s++)
                                <svg class="h-4 w-4 {{ $s <= $t->rating ? 'fill-current' : 'fill-gray-200' }}" viewBox="0 0 20 20">
                                    <path d="M10 15.27L16.18 19l-1.64-7.03L20 7.24l-7.19-.61L10 0 7.19 6.63 0 7.24l5.46 4.73L3.82 19z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 text-sm grow">&ldquo;{{ $t->content }}&rdquo;</p>
                        <div class="mt-5 flex items-center gap-3">
                            @if($t->avatar_url)
                                <img src="{{ $t->avatar_url }}" class="h-10 w-10 rounded-full object-cover" alt="{{ $t->name }}">
                            @else
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-semibold">
                                    {{ $t->initial }}
                                </span>
                            @endif
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">{{ $t->name }}</div>
                                @if($t->role)
                                    <div class="text-xs text-gray-500">{{ $t->role }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- FAQ --}}
    @if($faqs->count())
    <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Pertanyaan Umum</h2>
            <p class="text-gray-500 mt-2">Hal-hal yang sering ditanyakan pelanggan.</p>
        </div>
        <div class="space-y-3" data-aos="fade-up">
            @foreach($faqs as $faq)
                <div x-data="{ open: false }" class="rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left bg-white hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-900">{{ $faq->question }}</span>
                        <svg class="h-5 w-5 text-gray-400 shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-5 pb-4 text-sm text-gray-600 leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Kontak / Form --}}
    <section class="bg-gray-50 py-16" data-aos="fade-up">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Hubungi Kami</h2>
                <p class="text-gray-500 mt-2">Punya pertanyaan? Kirim pesan, kami akan segera membalas.</p>
            </div>

            @if(session('contact_status'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 text-center">
                    {{ session('contact_status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 space-y-5">
                @csrf
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP/WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan *</label>
                    <textarea name="message" rows="4" required
                              class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('message') }}</textarea>
                    @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white hover:bg-indigo-500 transition">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-indigo-600" data-aos="fade-up">
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
