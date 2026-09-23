<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductLookupController extends Controller
{
    /**
     * Return lightweight product cards for a given list of IDs.
     * Used by client-side wishlist & "recently viewed" (localStorage-based, no auth needed).
     */
    public function __invoke(Request $request)
    {
        $ids = collect(explode(',', (string) $request->query('ids')))
            ->map(fn ($id) => (int) trim($id))
            ->filter()
            ->take(50);

        if ($ids->isEmpty()) {
            return response()->json(['data' => []]);
        }

        $products = Product::active()->whereIn('id', $ids)->get();

        // Preserve the order requested by the client.
        $ordered = $ids->map(fn ($id) => $products->firstWhere('id', $id))->filter()->values();

        $data = $ordered->map(fn (Product $p) => [
            'id' => $p->id,
            'name' => $p->name,
            'slug' => $p->slug,
            'url' => route('products.show', $p),
            'image_url' => $p->image_url,
            'category' => $p->category ?? $p->type_label,
            'price' => $p->formatted_price,
            'short_description' => $p->short_description,
        ]);

        return response()->json(['data' => $data]);
    }
}
