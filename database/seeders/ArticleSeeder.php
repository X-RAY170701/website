<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => '5 Tips Memilih Template Digital yang Tepat untuk Bisnis Anda',
                'excerpt' => 'Panduan singkat memilih template digital yang sesuai kebutuhan dan target pasar bisnis Anda.',
                'content' => "Memilih template digital yang tepat bisa jadi tantangan tersendiri, apalagi dengan banyaknya pilihan yang tersedia.\n\nBerikut 5 tips singkat:\n1. Kenali kebutuhan spesifik bisnis Anda\n2. Perhatikan kemudahan kustomisasi\n3. Pastikan template responsif di HP\n4. Cek reputasi & testimoni penjual\n5. Pilih yang menyediakan dukungan revisi\n\nDengan mempertimbangkan poin-poin di atas, Anda bisa mendapatkan template yang benar-benar sesuai kebutuhan.",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Kenapa Bisnis Kecil Perlu Website Sendiri di 2026?',
                'excerpt' => 'Website bukan lagi kebutuhan mewah, tapi investasi penting untuk kredibilitas bisnis.',
                'content' => "Di era digital saat ini, memiliki website sendiri memberikan banyak keuntungan bagi bisnis kecil, mulai dari kredibilitas, jangkauan pasar yang lebih luas, hingga kemudahan promosi.\n\nBeberapa alasan utama:\n- Meningkatkan kepercayaan calon pelanggan\n- Media promosi yang bisa diakses 24 jam\n- Lebih mudah ditemukan lewat mesin pencari\n\nJika Anda belum punya website, sekarang saat yang tepat untuk memulainya.",
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($items as $item) {
            $item['slug'] = Str::slug($item['title']);
            Article::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
