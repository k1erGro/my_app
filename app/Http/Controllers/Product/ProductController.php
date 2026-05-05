<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $data = [];
        $hasReview = false;

        if (!$product->getPropertyValues()->isEmpty() && !$product->getPropertyValues()->isEmpty()) {
            foreach ($product->getPropertyValues() as $propertyValue) {
                $values[] = $propertyValue->getValue();
            }

            foreach ($product->getPropertyValues() as $propertyValue) {
                $property[] = Property::where("id", $propertyValue->property_id)->first()->getName();
            }

            $data = array_combine($property, $values);
        }
        if (Auth::check()) {
            $hasReview = Review::where('user_id', Auth::user()->getKey())->where('product_id', $product->getKey())->exists();
        }


        return view('shop.products.product', compact('product', 'data', 'hasReview'));
    }
}
