<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SubCategory $subCategory)
    {
        $products = $subCategory->products()
            ->withAvg('reviews', 'rating')
            ->when($request->sort === 'rating_desc', fn($q) =>
            $q->orderByRaw('reviews_avg_rating IS NULL ASC')->orderByDesc('reviews_avg_rating'))
            ->when($request->sort === 'rating_asc', fn($q) =>
            $q->orderByRaw('reviews_avg_rating IS NULL ASC')->orderBy('reviews_avg_rating'))
            ->unless($request->filled('sort'), fn($q) => $q->orderByDesc('id'))
            ->get();

        return view('shop.products.catalogProduct', compact('subCategory', 'products'));
    }
}
