<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan Masuk</h2>
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
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Pengirim</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Subjek</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($messages as $m)
                            <tr class="{{ $m->is_read ? '' : 'bg-indigo-50/40' }}">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $m->name }}</div>
                                    <div class="text-gray-400 text-xs">{{ $m->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $m->subject ?: '(tanpa subjek)' }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $m->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if($m->is_read)
                                        <span class="inline-flex rounded-full bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1">Dibaca</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1">Baru</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.messages.show', $m) }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">Lihat</a>
                                    <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">Belum ada pesan masuk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $messages->links() }}</div>
        </div>
    </div>
</x-app-layout>
