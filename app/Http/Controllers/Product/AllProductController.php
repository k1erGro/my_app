<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::paginate(10);
        return view('shop.products.index', compact('products'));
    }
}
