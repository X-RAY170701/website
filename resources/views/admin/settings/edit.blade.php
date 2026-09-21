<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengaturan Situs</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('status'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4">Identitas Brand</h3>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="site_name" value="Nama Brand/Situs *" />
                                <x-text-input id="site_name" name="site_name" type="text" class="mt-1 block w-full"
                                              :value="old('site_name', $settings->site_name)" required />
                            </div>
                            <div>
                                <x-input-label for="tagline" value="Tagline" />
                                <x-text-input id="tagline" name="tagline" type="text" class="mt-1 block w-full"
                                              :value="old('tagline', $settings->tagline)" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="logo" value="Logo" />
                            @if($settings->logo_url)
                                <img src="{{ $settings->logo_url }}" class="h-12 mt-2 mb-2">
                            @endif
                            <input id="logo" name="logo" type="file" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4">Halaman Beranda</h3>
                        <div>
                            <x-input-label for="hero_title" value="Judul Utama (Hero)" />
                            <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full"
                                          :value="old('hero_title', $settings->hero_title)" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="hero_subtitle" value="Sub-judul (Hero)" />
                            <textarea id="hero_subtitle" name="hero_subtitle" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('hero_subtitle', $settings->hero_subtitle) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="hero_image" value="Gambar Hero" />
                            @if($settings->hero_image_url)
                                <img src="{{ $settings->hero_image_url }}" class="h-24 rounded-lg mt-2 mb-2">
                            @endif
                            <input id="hero_image" name="hero_image" type="file" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100">
                        </div>
                        <div class="mt-4">
                            <x-input-label for="about_text" value="Tentang Kami" />
                            <textarea id="about_text" name="about_text" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('about_text', $settings->about_text) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4">Kontak</h3>
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="whatsapp_number" value="Nomor WhatsApp (format 62...)" />
                                <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full"
                                              :value="old('whatsapp_number', $settings->whatsapp_number)" placeholder="6281234567890" />
                            </div>
                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                              :value="old('email', $settings->email)" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="address" value="Alamat" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                          :value="old('address', $settings->address)" />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4">Media Sosial</h3>
                        <div class="grid sm:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="instagram_url" value="Instagram" />
                                <x-text-input id="instagram_url" name="instagram_url" type="url" class="mt-1 block w-full"
                                              :value="old('instagram_url', $settings->instagram_url)" placeholder="https://instagram.com/..." />
                            </div>
                            <div>
                                <x-input-label for="facebook_url" value="Facebook" />
                                <x-text-input id="facebook_url" name="facebook_url" type="url" class="mt-1 block w-full"
                                              :value="old('facebook_url', $settings->facebook_url)" placeholder="https://facebook.com/..." />
                            </div>
                            <div>
                                <x-input-label for="tiktok_url" value="TikTok" />
                                <x-text-input id="tiktok_url" name="tiktok_url" type="url" class="mt-1 block w-full"
                                              :value="old('tiktok_url', $settings->tiktok_url)" placeholder="https://tiktok.com/@..." />
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4">Statistik Pencapaian (tampil di beranda)</h3>
                        <div class="grid sm:grid-cols-4 gap-6">
                            <div>
                                <x-input-label for="stat_customers" value="Pelanggan Puas" />
                                <x-text-input id="stat_customers" name="stat_customers" type="text" class="mt-1 block w-full"
                                              :value="old('stat_customers', $settings->stat_customers)" placeholder="500+" />
                            </div>
                            <div>
                                <x-input-label for="stat_products" value="Produk Tersedia" />
                                <x-text-input id="stat_products" name="stat_products" type="text" class="mt-1 block w-full"
                                              :value="old('stat_products', $settings->stat_products)" placeholder="50+" />
                            </div>
                            <div>
                                <x-input-label for="stat_experience" value="Tahun Pengalaman" />
                                <x-text-input id="stat_experience" name="stat_experience" type="text" class="mt-1 block w-full"
                                              :value="old('stat_experience', $settings->stat_experience)" placeholder="3+" />
                            </div>
                            <div>
                                <x-input-label for="stat_satisfaction" value="Tingkat Kepuasan" />
                                <x-text-input id="stat_satisfaction" name="stat_satisfaction" type="text" class="mt-1 block w-full"
                                              :value="old('stat_satisfaction', $settings->stat_satisfaction)" placeholder="98%" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-4">SEO & Pratinjau Media Sosial</h3>
                        <div>
                            <x-input-label for="meta_title" value="Judul SEO (tab browser & hasil pencarian)" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full"
                                          :value="old('meta_title', $settings->meta_title)" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="meta_description" value="Deskripsi SEO" />
                            <textarea id="meta_description" name="meta_description" rows="2" maxlength="500"
                                      class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description', $settings->meta_description) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <x-input-label for="footer_text" value="Teks Footer" />
                        <x-text-input id="footer_text" name="footer_text" type="text" class="mt-1 block w-full"
                                      :value="old('footer_text', $settings->footer_text)" />
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <x-primary-button>Simpan Pengaturan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
