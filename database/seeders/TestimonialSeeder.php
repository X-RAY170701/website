<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Dewi Anggraini',
                'role' => 'Pemilik Toko Online',
                'content' => 'Prosesnya cepat banget, admin-nya responsif di WhatsApp. Template yang saya beli langsung bisa dipakai, hasilnya rapi dan profesional.',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Founder Startup',
                'content' => 'Jasa pembuatan website-nya sangat memuaskan. Komunikasi lancar, hasil sesuai brief, dan harganya masuk akal untuk kualitas segini.',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'name' => 'Siti Rahma',
                'role' => 'Guru & Content Creator',
                'content' => 'E-book panduan digital marketing-nya sangat membantu, bahasanya mudah dipahami dan langsung bisa dipraktikkan.',
                'rating' => 4,
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
