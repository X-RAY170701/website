<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->exists ? 'Edit Artikel' : 'Tambah Artikel' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if($article->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="title" value="Judul *" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $article->title)" required />
                    </div>

                    <div>
                        <x-input-label for="excerpt" value="Ringkasan Singkat" />
                        <x-text-input id="excerpt" name="excerpt" type="text" class="mt-1 block w-full" :value="old('excerpt', $article->excerpt)" maxlength="255" />
                    </div>

                    <div>
                        <x-input-label for="content" value="Isi Artikel *" />
                        <textarea id="content" name="content" rows="10" required
                                  class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="cover_image" value="Gambar Sampul" />
                        @if($article->cover_image_url)
                            <img src="{{ $article->cover_image_url }}" class="h-24 rounded-lg mt-2 mb-2">
                        @endif
                        <input id="cover_image" name="cover_image" type="file" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100">
                    </div>

                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                               @checked(old('is_published', $article->exists ? $article->is_published : true))>
                        <span class="text-sm text-gray-700">Publikasikan (tampil di situs)</span>
                    </label>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button>{{ $article->exists ? 'Simpan Perubahan' : 'Tambah Artikel' }}</x-primary-button>
                        <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
