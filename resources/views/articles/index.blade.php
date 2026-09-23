<x-layouts.public :settings="$settings" :title="'Artikel — '.$settings->site_name">

    <section class="bg-gray-50 dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Artikel & Tips</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Wawasan, tips, dan berita seputar produk digital kami.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($articles->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article) }}" data-aos="fade-up"
                       class="group flex flex-col rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm hover:shadow-lg transition overflow-hidden">
                        <div class="aspect-[16/9] bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            @if($article->cover_image_url)
                                <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900">📝</div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col grow">
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ optional($article->published_at)->format('d M Y') }}</span>
                            <h2 class="mt-1 font-semibold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2">{{ $article->title }}</h2>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 line-clamp-3 grow">{{ $article->excerpt }}</p>
                            <span class="mt-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400">Baca selengkapnya →</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">{{ $articles->links() }}</div>
        @else
            <div class="text-center py-20">
                <div class="text-5xl mb-4">📝</div>
                <p class="text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
            </div>
        @endif
    </section>

</x-layouts.public>
