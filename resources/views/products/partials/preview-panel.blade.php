@php($label ??= null)
@php($height ??= 640)
<div x-data="{ loading: true }">
    @if($label)
        <div class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2">{{ $label }}</div>
    @endif
    <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg">
        {{-- Bar ala browser, biar konteksnya jelas ini pratinjau situs lain --}}
        <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800 px-4 py-2.5 border-b border-gray-200 dark:border-gray-700">
            <span class="h-3 w-3 rounded-full bg-red-400"></span>
            <span class="h-3 w-3 rounded-full bg-amber-400"></span>
            <span class="h-3 w-3 rounded-full bg-green-400"></span>
            <span class="ml-3 text-xs text-gray-500 dark:text-gray-400 truncate font-mono">{{ $url }}</span>
        </div>
        <div class="relative bg-white" style="height: {{ $height }}px;">
            <div x-show="loading" class="absolute inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-900">
                <svg class="animate-spin h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
            <iframe src="{{ $url }}" @load="loading = false"
                    class="w-full h-full border-0" loading="lazy"
                    title="Pratinjau {{ $label ?? $url }}"></iframe>
        </div>
    </div>
</div>
