<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, SubCategory $subCategory)
    {
        return view('shop.products.catalogProduct', compact('subCategory'));
    }
}
