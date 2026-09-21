<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $faq->exists ? 'Edit FAQ' : 'Tambah FAQ' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}"
                      class="space-y-6">
                    @csrf
                    @if($faq->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="question" value="Pertanyaan *" />
                        <x-text-input id="question" name="question" type="text" class="mt-1 block w-full" :value="old('question', $faq->question)" required />
                    </div>

                    <div>
                        <x-input-label for="answer" value="Jawaban *" />
                        <textarea id="answer" name="answer" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('answer', $faq->answer) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="sort_order" value="Urutan Tampil" />
                        <x-text-input id="sort_order" name="sort_order" type="number" min="0" class="mt-1 block w-40" :value="old('sort_order', $faq->sort_order ?? 0)" />
                    </div>

                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                               @checked(old('is_active', $faq->exists ? $faq->is_active : true))>
                        <span class="text-sm text-gray-700">Aktif (tampil di situs)</span>
                    </label>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button>{{ $faq->exists ? 'Simpan Perubahan' : 'Tambah FAQ' }}</x-primary-button>
                        <a href="{{ route('admin.faqs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
