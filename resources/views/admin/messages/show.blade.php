<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesan</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-5">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="font-semibold text-gray-900 text-lg">{{ $message->name }}</div>
                        <div class="text-gray-500 text-sm">{{ $message->email }}</div>
                        @if($message->phone)
                            <div class="text-gray-500 text-sm">{{ $message->phone }}</div>
                        @endif
                    </div>
                    <div class="text-xs text-gray-400">{{ $message->created_at->format('d M Y H:i') }}</div>
                </div>

                @if($message->subject)
                    <div>
                        <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Subjek</div>
                        <div class="text-gray-800">{{ $message->subject }}</div>
                    </div>
                @endif

                <div>
                    <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Pesan</div>
                    <div class="text-gray-800 whitespace-pre-line leading-relaxed">{{ $message->message }}</div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                    <a href="mailto:{{ $message->email }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500">
                        Balas via Email
                    </a>
                    @if($message->phone)
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $message->phone) }}" target="_blank"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Balas via WhatsApp
                        </a>
                    @endif
                    <a href="{{ route('admin.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-700 ml-auto">← Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
