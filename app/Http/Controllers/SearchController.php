<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = trim($request->input('query', ''));

        if (empty($query) || mb_strlen($query) < 2) {
            return view('search.index', [
                'products' => collect(),
                'query' => $query
            ]);
        }

        $products = Product::search($query)
            ->with(['categories'])
            ->paginate(12)
            ->withQueryString();

        return view('search.index', compact('products', 'query'));
    }
}
