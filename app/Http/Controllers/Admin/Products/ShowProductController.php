<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.product.show', compact('product', 'data'));
    }
}
