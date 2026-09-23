<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::current();

        $query = Product::active()->orderBy('sort_order');

        if ($request->filled('type')) {
            $query->where('type', $request->string('type'));
        }

        if ($request->filled('q')) {
            $search = $request->string('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(9)->withQueryString();

        return view('products.index', compact('settings', 'products'));
    }

    public function show(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        // Debounce view counting per browser session so refreshing doesn't inflate the count.
        $sessionKey = 'viewed_product_'.$product->id;
        if (! $request->session()->has($sessionKey)) {
            $product->increment('views_count');
            $request->session()->put($sessionKey, true);
        }

        $settings = SiteSetting::current();
        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->where('type', $product->type)
            ->take(3)
            ->get();

        return view('products.show', compact('settings', 'product', 'related'));
    }
}
