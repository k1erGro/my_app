<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class EditProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $propertyValues = PropertyValue::with('property')->get();
        $properties = Property::all();
        $addresses = Address::all();
        return view('admin.product.edit', compact('product', 'categories', 'propertyValues', 'properties', 'subCategories', 'addresses'));
    }
}
