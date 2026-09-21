<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola FAQ</h2>
            <a href="{{ route('admin.faqs.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                + Tambah FAQ
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
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Pertanyaan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($faqs as $faq)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $faq->question }}</div>
                                    <div class="text-gray-400 text-xs max-w-lg truncate">{{ $faq->answer }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($faq->is_active)
                                        <span class="inline-flex rounded-full bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1">Aktif</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1">Draft</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">Edit</a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Hapus FAQ ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-10 text-center text-gray-400">Belum ada FAQ.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $faqs->links() }}</div>
        </div>
    </div>
</x-app-layout>
