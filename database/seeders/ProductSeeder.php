<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Template Undangan Digital Elegant',
                'type' => 'digital_file',
                'category' => 'Template',
                'short_description' => 'Template undangan digital siap pakai, tinggal edit nama & tanggal.',
                'description' => "Template undangan digital dengan desain elegan, responsif di HP, dan mudah dikustomisasi. Cocok untuk pernikahan, ulang tahun, atau acara resmi lainnya.\n\nFitur:\n- Desain modern & elegan\n- Mudah diedit\n- Bisa dibagikan lewat link/WhatsApp",
                'price' => 150000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'E-Book Panduan Digital Marketing',
                'type' => 'digital_file',
                'category' => 'E-Book',
                'short_description' => 'Panduan lengkap strategi pemasaran digital untuk pemula hingga mahir.',
                'description' => "E-book berisi panduan step-by-step digital marketing: SEO, iklan media sosial, copywriting, dan strategi konten.\n\nFormat: PDF, 80+ halaman.",
                'price' => 75000,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Source Code Aplikasi Kasir (POS)',
                'type' => 'digital_file',
                'category' => 'Source Code',
                'short_description' => 'Source code aplikasi kasir siap pakai, mudah dikustomisasi.',
                'description' => "Source code lengkap aplikasi Point of Sale berbasis web. Cocok untuk developer atau pemilik usaha yang ingin punya sistem kasir sendiri.\n\nTermasuk dokumentasi instalasi.",
                'price' => 500000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Jasa Pembuatan Website Company Profile',
                'type' => 'service',
                'category' => 'Jasa Development',
                'short_description' => 'Jasa pembuatan website company profile profesional & responsif.',
                'description' => "Kami membantu membuatkan website company profile untuk bisnis Anda, mulai dari desain hingga siap online.\n\nProses konsultasi kebutuhan dilakukan via WhatsApp.",
                'price' => null,
                'price_label' => 'Mulai dari Rp 1.500.000',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Jasa Desain Logo & Brand Identity',
                'type' => 'service',
                'category' => 'Jasa Desain',
                'short_description' => 'Jasa desain logo profesional lengkap dengan panduan brand.',
                'description' => "Desain logo custom sesuai identitas brand Anda, lengkap dengan file source dan panduan penggunaan warna & font.",
                'price' => null,
                'price_label' => 'Hubungi kami untuk penawaran',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Template Slide Presentasi Bisnis',
                'type' => 'digital_file',
                'category' => 'Template',
                'short_description' => 'Template PowerPoint/Canva untuk presentasi bisnis & pitching.',
                'description' => "Kumpulan template slide presentasi yang siap pakai untuk kebutuhan bisnis, proposal, dan pitching investor.",
                'price' => 50000,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::updateOrCreate(['name' => $product['name']], $product);
        }
    }
}
