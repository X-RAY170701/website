<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'category',
        'short_description',
        'description',
        'price',
        'price_label',
        'image_path',
        'external_link',
        'cta_label',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : null;
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'digital_file' => 'Produk Digital',
            'service' => 'Jasa/Layanan',
            default => 'Lainnya',
        };
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_label) {
            return $this->price_label;
        }

        if ($this->price === null) {
            return 'Hubungi Kami';
        }

        return 'Rp '.number_format((float) $this->price, 0, ',', '.');
    }
}
