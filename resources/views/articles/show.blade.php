<x-layouts.public :settings="$settings" :title="$article->title.' — '.$settings->site_name">

    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('articles.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Artikel</a>
        </nav>

        <span class="text-xs text-gray-400 dark:text-gray-500">
            {{ optional($article->published_at)->format('d M Y') }} · {{ number_format($article->views_count) }}x dibaca
        </span>
        <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-gray-100">{{ $article->title }}</h1>

        @if($article->cover_image_url)
            <div class="mt-8 rounded-2xl overflow-hidden aspect-[16/9] bg-gray-100 dark:bg-gray-800">
                <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="mt-8 prose prose-indigo dark:prose-invert max-w-none whitespace-pre-line">
            {{ $article->content }}
        </div>

        {{-- Bagikan artikel --}}
        @php
            $shareUrl = rawurlencode(url()->current());
            $shareText = rawurlencode($article->title);
        @endphp
        <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-800 flex items-center gap-3">
            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Bagikan:</span>
            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp"
               class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-green-50 dark:bg-green-950 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900 transition">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.85.505 3.583 1.385 5.077L2 22l5.077-1.36A9.953 9.953 0 0 0 12.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.06a8.03 8.03 0 0 1-4.098-1.126l-.294-.175-3.017.808.806-2.943-.192-.303A8.03 8.03 0 0 1 3.94 12c0-4.444 3.616-8.06 8.061-8.06 4.444 0 8.06 3.616 8.06 8.06 0 4.444-3.616 8.06-8.06 8.06z"/></svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook"
               class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 transition">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
            </a>
        </div>

        @if($related->count())
            <div class="mt-16">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Artikel Lainnya</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('articles.show', $item) }}" class="group">
                            <div class="aspect-[16/9] rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 mb-3">
                                @if($item->cover_image_url)
                                    <img src="{{ $item->cover_image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-2xl">📝</div>
                                @endif
                            </div>
                            <div class="font-semibold text-sm text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 line-clamp-2">{{ $item->title }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>

</x-layouts.public>
