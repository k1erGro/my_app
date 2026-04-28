<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $properties = Property::all();
        return view('admin.product.create', compact('categories', 'properties', 'subCategories'));
    }
}
