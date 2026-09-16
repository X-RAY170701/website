<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->exists ? 'Edit Produk' : 'Tambah Produk' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if($product->exists)
                        @method('PUT')
                    @endif

                    <div>
                        <x-input-label for="name" value="Nama Produk *" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name', $product->name)" required />
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" value="Tipe Produk *" />
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach(['digital_file' => 'Produk Digital (file)', 'service' => 'Jasa/Layanan', 'other' => 'Lainnya'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('type', $product->type) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="category" value="Kategori" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full"
                                          :value="old('category', $product->category)" placeholder="mis. Template, E-Book, Jasa Desain" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="short_description" value="Deskripsi Singkat" />
                        <x-text-input id="short_description" name="short_description" type="text" class="mt-1 block w-full"
                                      :value="old('short_description', $product->short_description)" maxlength="255" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi Lengkap" />
                        <textarea id="description" name="description" rows="6"
                                  class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="price" value="Harga (Rp)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full"
                                          :value="old('price', $product->price)" placeholder="Kosongkan jika pakai label harga" />
                        </div>
                        <div>
                            <x-input-label for="price_label" value="Label Harga (opsional)" />
                            <x-text-input id="price_label" name="price_label" type="text" class="mt-1 block w-full"
                                          :value="old('price_label', $product->price_label)" placeholder="mis. Mulai dari Rp 500.000" />
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="cta_label" value="Label Tombol CTA" />
                            <x-text-input id="cta_label" name="cta_label" type="text" class="mt-1 block w-full"
                                          :value="old('cta_label', $product->cta_label ?: 'Pesan via WhatsApp')" />
                        </div>
                        <div>
                            <x-input-label for="external_link" value="Link Eksternal (opsional)" />
                            <x-text-input id="external_link" name="external_link" type="url" class="mt-1 block w-full"
                                          :value="old('external_link', $product->external_link)" placeholder="https://..." />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image" value="Gambar Produk" />
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" class="h-20 w-20 object-cover rounded-lg mt-2 mb-2">
                        @endif
                        <input id="image" name="image" type="file" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100">
                    </div>

                    <div class="flex flex-wrap gap-6">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                   @checked(old('is_active', $product->exists ? $product->is_active : true))>
                            <span class="text-sm text-gray-700">Aktif (tampil di situs)</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                   @checked(old('is_featured', $product->is_featured))>
                            <span class="text-sm text-gray-700">Tampilkan sebagai Unggulan</span>
                        </label>
                    </div>

                    <div>
                        <x-input-label for="sort_order" value="Urutan Tampil" />
                        <x-text-input id="sort_order" name="sort_order" type="number" min="0" class="mt-1 block w-40"
                                      :value="old('sort_order', $product->sort_order ?? 0)" />
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button>{{ $product->exists ? 'Simpan Perubahan' : 'Tambah Produk' }}</x-primary-button>
                        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
