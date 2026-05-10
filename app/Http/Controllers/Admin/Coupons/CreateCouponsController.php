<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CreateCouponsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $subCategories = SubCategory::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        return view('admin.coupons.create', compact('subCategories', 'products'));
    }
}
