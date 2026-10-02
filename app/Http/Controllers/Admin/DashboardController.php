<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'views_today' => PageView::today()->count(),
            'views_month' => PageView::thisMonth()->count(),
            'views_total' => PageView::count(),
            'unique_visitors_month' => PageView::thisMonth()->distinct('ip_hash')->count('ip_hash'),
        ];

        // Grafik kunjungan 30 hari terakhir.
        $start = Carbon::today()->subDays(29);
        $rows = PageView::betweenDates($start->copy()->startOfDay(), Carbon::today()->endOfDay())
            ->select(DB::raw("DATE(viewed_at) as day"), DB::raw('count(*) as total'))
            ->groupBy('day')
            ->pluck('total', 'day');

        $chart = [];
        for ($d = $start->copy(); $d->lte(Carbon::today()); $d->addDay()) {
            $key = $d->toDateString();
            $chart[] = [
                'label' => $d->translatedFormat('d M'),
                'total' => (int) ($rows[$key] ?? 0),
            ];
        }

        // Halaman paling banyak dikunjungi bulan ini.
        $topPages = PageView::thisMonth()
            ->select('path', DB::raw('count(*) as total'))
            ->groupBy('path')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $quick = [
            'products' => Product::count(),
            'products_active' => Product::active()->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats', 'chart', 'topPages', 'quick'));
    }
}
