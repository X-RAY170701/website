@php($settings = \App\Models\SiteSetting::current())
<x-layouts.public :settings="$settings" :title="'Halaman Tidak Ditemukan — '.$settings->site_name">

    <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <div class="text-7xl mb-6">🧭</div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-gray-100">Halaman Tidak Ditemukan</h1>
        <p class="mt-4 text-gray-500 dark:text-gray-400">
            Sepertinya halaman yang kamu cari sudah dipindahkan, dihapus, atau memang tidak pernah ada.
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white hover:bg-indigo-500 transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 px-6 py-3 font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                Lihat Produk
            </a>
        </div>
    </section>

</x-layouts.public>
