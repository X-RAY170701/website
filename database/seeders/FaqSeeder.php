<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'question' => 'Bagaimana cara memesan produk?',
                'answer' => 'Cukup pilih produk yang Anda inginkan, lalu klik tombol "Pesan via WhatsApp" pada halaman detail produk. Tim kami akan membalas dan membantu proses pemesanan Anda.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Saat ini pemesanan diproses langsung melalui WhatsApp, dan tim kami akan menginformasikan metode pembayaran yang tersedia (transfer bank/e-wallet) saat konfirmasi pesanan.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Apakah produk digital bisa direvisi/disesuaikan?',
                'answer' => 'Bisa. Untuk produk seperti template atau desain, kami menyediakan opsi kustomisasi ringan. Silakan sampaikan kebutuhan Anda saat chat dengan admin.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Berapa lama proses pengerjaan jasa/layanan?',
                'answer' => 'Estimasi waktu pengerjaan bervariasi tergantung jenis layanan, umumnya 3-7 hari kerja setelah kebutuhan disepakati. Detail waktu akan diinformasikan saat konsultasi.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Apakah ada garansi jika produk tidak sesuai?',
                'answer' => 'Kami berkomitmen pada kualitas produk. Jika ada kendala teknis pada produk digital yang dibeli, silakan hubungi kami untuk bantuan lebih lanjut.',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            Faq::updateOrCreate(['question' => $item['question']], $item);
        }
    }
}
