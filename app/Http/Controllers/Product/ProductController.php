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
    public function __invoke(Product $product, Request $request) // Добавили Request
    {
        $data = [];
        $hasReview = false;
        $user = Auth::user();
        $isSubscribed = false;

        if (!$product->getPropertyValues()->isEmpty()) {
            foreach ($product->getPropertyValues() as $propertyValue) {
                $values[] = $propertyValue->getValue();
            }

            foreach ($product->getPropertyValues() as $propertyValue) {
                $property[] = Property::where("id", $propertyValue->property_id)->first()->getName();
            }

            $data = array_combine($property, $values);
        }

        if (Auth::check()) {
            $hasReview = Review::where('user_id', $user->getKey())->where('product_id', $product->getKey())->exists();
            $isSubscribed = $user->productSubscriptions()->where('product_id', $product->getKey())->exists();
        }

        $currentSort = $request->input('sort_reviews', 'newest');

        $reviews = $product->getSortedReviews($currentSort);

        return view('shop.products.product', compact('product', 'data', 'hasReview', 'isSubscribed', 'reviews', 'currentSort'));
    }
}
