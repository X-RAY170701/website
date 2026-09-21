<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'tagline',
        'hero_title',
        'hero_subtitle',
        'about_text',
        'logo_path',
        'hero_image_path',
        'whatsapp_number',
        'email',
        'address',
        'instagram_url',
        'facebook_url',
        'tiktok_url',
        'footer_text',
        'stat_customers',
        'stat_products',
        'stat_experience',
        'stat_satisfaction',
        'meta_title',
        'meta_description',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'site_name' => 'Nama Brand Anda',
            'tagline' => 'Solusi digital untuk kebutuhan Anda',
            'hero_title' => 'Produk Digital Berkualitas untuk Bisnis & Kebutuhan Anda',
            'hero_subtitle' => 'Kami menghadirkan produk dan layanan digital yang praktis, cepat, dan terpercaya.',
            'about_text' => 'Tuliskan cerita singkat tentang brand/produk Anda di sini. Jelaskan siapa Anda, apa yang Anda tawarkan, dan mengapa pelanggan harus memilih Anda.',
            'whatsapp_number' => '6281234567890',
            'email' => 'halo@contohbrand.com',
            'footer_text' => 'Semua hak cipta dilindungi.',
            'stat_customers' => '500+',
            'stat_products' => '50+',
            'stat_experience' => '3+',
            'stat_satisfaction' => '98%',
            'meta_title' => 'Nama Brand Anda — Produk Digital Berkualitas',
            'meta_description' => 'Solusi digital untuk kebutuhan Anda: template, e-book, source code, dan jasa digital lainnya.',
        ]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? asset('storage/'.$this->logo_path) : null;
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->hero_image_path ? asset('storage/'.$this->hero_image_path) : null;
    }

    public function getWhatsappLinkAttribute(): string
    {
        $number = preg_replace('/\D/', '', (string) $this->whatsapp_number);

        return 'https://wa.me/'.$number;
    }
}
