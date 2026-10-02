<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stat cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Dilihat Hari Ini</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($stats['views_today']) }}</div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Dilihat Bulan Ini</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($stats['views_month']) }}</div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pengunjung Unik (Bulan Ini)</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($stats['unique_visitors_month']) }}</div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total Sepanjang Waktu</div>
                    <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($stats['views_total']) }}</div>
                </div>
            </div>

            {{-- Chart 30 hari --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Kunjungan 30 Hari Terakhir</h3>
                <div class="relative" style="height: 280px;">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">
                {{-- Halaman terpopuler --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Halaman Terpopuler Bulan Ini</h3>
                    </div>
                    @if($topPages->isEmpty())
                        <p class="px-5 sm:px-6 py-8 text-sm text-gray-400 text-center">Belum ada data kunjungan bulan ini.</p>
                    @else
                        <table class="min-w-full text-sm">
                            <tbody class="divide-y divide-gray-100">
                                @foreach($topPages as $page)
                                    <tr>
                                        <td class="px-5 sm:px-6 py-3 text-gray-700 font-mono text-xs">{{ $page->path }}</td>
                                        <td class="px-5 sm:px-6 py-3 text-right font-semibold text-gray-900">{{ number_format($page->total) }}x</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                {{-- Ringkasan cepat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6 space-y-4">
                    <h3 class="font-semibold text-gray-800">Ringkasan</h3>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Produk aktif</span>
                        <span class="font-semibold text-gray-900">{{ $quick['products_active'] }} / {{ $quick['products'] }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Pesan belum dibaca</span>
                        <a href="{{ route('admin.messages.index') }}" class="font-semibold {{ $quick['unread_messages'] > 0 ? 'text-indigo-600 hover:text-indigo-500' : 'text-gray-900' }}">
                            {{ $quick['unread_messages'] }}
                        </a>
                    </div>
                    <div class="pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                            Kelola Produk →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('viewsChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(collect($chart)->pluck('label')),
                datasets: [{
                    label: 'Dilihat',
                    data: @json(collect($chart)->pluck('total')),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } },
                },
            },
        });
    </script>
</x-app-layout>
