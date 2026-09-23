<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Artikel</h2>
            <a href="{{ route('admin.articles.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                + Tambah Artikel
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Judul</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Dilihat</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($articles as $article)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $article->title }}</div>
                                    <div class="text-gray-400 text-xs">{{ $article->excerpt }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ number_format($article->views_count) }}</td>
                                <td class="px-6 py-4">
                                    @if($article->is_published)
                                        <span class="inline-flex rounded-full bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1">Publish</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('articles.show', $article) }}" target="_blank" class="text-gray-500 hover:text-gray-700">Lihat</a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">Edit</a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400">Belum ada artikel.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $articles->links() }}</div>
        </div>
    </div>
</x-app-layout>
