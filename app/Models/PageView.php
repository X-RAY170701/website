<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = ['path', 'ip_hash', 'user_agent', 'viewed_at'];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function scopeToday($query)
    {
        return $query->whereDate('viewed_at', now()->toDateString());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('viewed_at', now()->year)->whereMonth('viewed_at', now()->month);
    }

    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('viewed_at', [$start, $end]);
    }
}
