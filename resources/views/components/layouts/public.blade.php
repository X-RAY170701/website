<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $settings->meta_description ?? $settings->tagline ?? config('app.name') }}">

    <title>{{ $title ?? $settings->meta_title ?? $settings->site_name ?? config('app.name') }}</title>

    {{-- Open Graph / social share --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? $settings->meta_title ?? $settings->site_name }}">
    <meta property="og:description" content="{{ $settings->meta_description ?? $settings->tagline }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($settings->hero_image_url)
        <meta property="og:image" content="{{ $settings->hero_image_url }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800 bg-white" x-data="{ scrolled: false, showTop: false }"
      x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10; showTop = window.scrollY > 500; })">

    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-gray-100 transition-shadow"
            :class="scrolled ? 'shadow-md' : ''" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-extrabold text-lg text-indigo-600">
                    @if($settings->logo_url ?? null)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}" class="h-9 w-auto">
                    @else
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                            {{ mb_substr($settings->site_name ?? 'B', 0, 1) }}
                        </span>
                    @endif
                    <span>{{ $settings->site_name ?? config('app.name') }}</span>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-indigo-600 {{ request()->routeIs('home') ? 'text-indigo-600' : 'text-gray-600' }}">Beranda</a>
                    <a href="{{ route('products.index') }}" class="hover:text-indigo-600 {{ request()->routeIs('products.*') ? 'text-indigo-600' : 'text-gray-600' }}">Produk</a>
                    <a href="{{ route('home') }}#tentang" class="hover:text-indigo-600 text-gray-600">Tentang</a>
                    <a href="{{ route('home') }}#faq" class="hover:text-indigo-600 text-gray-600">FAQ</a>
                    <a href="{{ route('home') }}#kontak" class="hover:text-indigo-600 text-gray-600">Kontak</a>
                </nav>

                <div class="hidden md:block">
                    <a href="{{ $settings->whatsapp_link ?? '#' }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        Hubungi Kami
                    </a>
                </div>

                <button @click="open = !open" class="md:hidden p-2 text-gray-500" aria-label="Menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div x-show="open" x-cloak class="md:hidden pb-4 space-y-1">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700">Beranda</a>
                <a href="{{ route('products.index') }}" class="block py-2 text-gray-700">Produk</a>
                <a href="{{ route('home') }}#tentang" class="block py-2 text-gray-700">Tentang</a>
                <a href="{{ route('home') }}#faq" class="block py-2 text-gray-700">FAQ</a>
                <a href="{{ route('home') }}#kontak" class="block py-2 text-gray-700">Kontak</a>
                <a href="{{ $settings->whatsapp_link ?? '#' }}" target="_blank" class="block py-2 text-indigo-600 font-semibold">Hubungi Kami</a>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer id="kontak" class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="text-white font-bold text-lg mb-3">{{ $settings->site_name ?? config('app.name') }}</div>
                <p class="text-sm text-gray-400">{{ $settings->tagline }}</p>
            </div>
            <div>
                <div class="text-white font-semibold mb-3">Kontak</div>
                <ul class="text-sm space-y-2 text-gray-400">
                    @if($settings->whatsapp_number)
                        <li>WhatsApp: <a href="{{ $settings->whatsapp_link }}" class="hover:text-white" target="_blank">{{ $settings->whatsapp_number }}</a></li>
                    @endif
                    @if($settings->email)
                        <li>Email: <a href="mailto:{{ $settings->email }}" class="hover:text-white">{{ $settings->email }}</a></li>
                    @endif
                    @if($settings->address)
                        <li>{{ $settings->address }}</li>
                    @endif
                </ul>
            </div>
            <div>
                <div class="text-white font-semibold mb-3">Ikuti Kami</div>
                <ul class="text-sm space-y-2 text-gray-400">
                    @if($settings->instagram_url)
                        <li><a href="{{ $settings->instagram_url }}" class="hover:text-white" target="_blank">Instagram</a></li>
                    @endif
                    @if($settings->facebook_url)
                        <li><a href="{{ $settings->facebook_url }}" class="hover:text-white" target="_blank">Facebook</a></li>
                    @endif
                    @if($settings->tiktok_url)
                        <li><a href="{{ $settings->tiktok_url }}" class="hover:text-white" target="_blank">TikTok</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 py-5 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ $settings->site_name ?? config('app.name') }}. {{ $settings->footer_text }}
        </div>
    </footer>

    {{-- Tombol WhatsApp mengambang --}}
    @if($settings->whatsapp_number)
        <a href="{{ $settings->whatsapp_link }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp"
           class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center h-14 w-14 rounded-full bg-green-500 text-white shadow-lg shadow-green-500/30 hover:bg-green-400 hover:scale-105 transition">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.85.505 3.583 1.385 5.077L2 22l5.077-1.36A9.953 9.953 0 0 0 12.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.06a8.03 8.03 0 0 1-4.098-1.126l-.294-.175-3.017.808.806-2.943-.192-.303A8.03 8.03 0 0 1 3.94 12c0-4.444 3.616-8.06 8.061-8.06 4.444 0 8.06 3.616 8.06 8.06 0 4.444-3.616 8.06-8.06 8.06z"/>
            </svg>
        </a>
    @endif

    {{-- Tombol kembali ke atas --}}
    <button x-show="showTop" x-cloak x-transition @click="window.scrollTo({top:0, behavior:'smooth'})" aria-label="Kembali ke atas"
            class="fixed bottom-6 left-6 z-50 inline-flex items-center justify-center h-11 w-11 rounded-full bg-gray-900/80 text-white shadow-lg hover:bg-gray-900 transition">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.AOS) { AOS.init({ duration: 700, once: true, offset: 60 }); }
        });
    </script>
</body>
</html>
