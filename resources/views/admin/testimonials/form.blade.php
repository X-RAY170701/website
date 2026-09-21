<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni' }}
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
                      action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if($testimonial->exists) @method('PUT') @endif

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="Nama *" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $testimonial->name)" required />
                        </div>
                        <div>
                            <x-input-label for="role" value="Jabatan/Peran" />
                            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $testimonial->role)" placeholder="mis. Pemilik Toko Online" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="content" value="Isi Testimoni *" />
                        <textarea id="content" name="content" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $testimonial->content) }}</textarea>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="rating" value="Rating" />
                            <select id="rating" name="rating" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating', $testimonial->rating ?? 5) == $i)>{{ $i }} Bintang</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <x-input-label for="sort_order" value="Urutan Tampil" />
                            <x-text-input id="sort_order" name="sort_order" type="number" min="0" class="mt-1 block w-full" :value="old('sort_order', $testimonial->sort_order ?? 0)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="avatar" value="Foto (opsional)" />
                        @if($testimonial->avatar_url)
                            <img src="{{ $testimonial->avatar_url }}" class="h-16 w-16 object-cover rounded-full mt-2 mb-2">
                        @endif
                        <input id="avatar" name="avatar" type="file" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100">
                    </div>

                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                               @checked(old('is_active', $testimonial->exists ? $testimonial->is_active : true))>
                        <span class="text-sm text-gray-700">Aktif (tampil di situs)</span>
                    </label>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button>{{ $testimonial->exists ? 'Simpan Perubahan' : 'Tambah Testimoni' }}</x-primary-button>
                        <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
