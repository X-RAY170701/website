<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Catat setiap kunjungan halaman publik untuk statistik dashboard admin
 * (total hari ini / bulan ini / semua waktu). IP disimpan dalam bentuk
 * hash (bukan mentah) sebagai praktik privasi yang lebih baik -- cukup
 * untuk hitung "pengunjung unik" tanpa menyimpan data pribadi apa adanya.
 */
class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            PageView::create([
                'path' => '/'.ltrim($request->path(), '/'),
                'ip_hash' => hash('sha256', $request->ip().config('app.key')),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
                'viewed_at' => now(),
            ]);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || $request->ajax() || $request->expectsJson()) {
            return false;
        }

        if ($response->getStatusCode() >= 400) {
            return false;
        }

        return true;
    }
}
