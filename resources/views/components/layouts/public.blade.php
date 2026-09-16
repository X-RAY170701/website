<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $settings->tagline ?? config('app.name') }}">

    <title>{{ $title ?? $settings->site_name ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-gray-100" x-data="{ open: false }">
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

</body>
</html>
