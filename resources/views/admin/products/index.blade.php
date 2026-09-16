<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Produk</h2>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                + Tambah Produk
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
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Produk</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tipe</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Harga</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-lg bg-gray-100 overflow-hidden flex items-center justify-center shrink-0">
                                            @if($product->image_url)
                                                <img src="{{ $product->image_url }}" class="h-full w-full object-cover">
                                            @else
                                                <span>📦</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $product->name }}</div>
                                            <div class="text-gray-400 text-xs">{{ $product->category }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $product->type_label }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $product->formatted_price }}</td>
                                <td class="px-6 py-4">
                                    @if($product->is_active)
                                        <span class="inline-flex rounded-full bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1">Aktif</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1">Draft</span>
                                    @endif
                                    @if($product->is_featured)
                                        <span class="inline-flex rounded-full bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-1 ml-1">Unggulan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('products.show', $product) }}" target="_blank" class="text-gray-500 hover:text-gray-700">Lihat</a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Hapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">Belum ada produk. Klik "Tambah Produk" untuk mulai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
