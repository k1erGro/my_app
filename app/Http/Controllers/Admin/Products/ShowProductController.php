<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        foreach ($product->getPropertyValues() as $propertyValue) {
            $values[] = $propertyValue->getValue();
        }
        foreach ($product->getPropertyValues() as $propertyValue) {
            $property[] = Property::where("id", $propertyValue->property_id)->first()->getName();
        }
        $data = array_combine($property, $values);

        return view('shop.products.product', compact('product', 'data'));
    }
}
