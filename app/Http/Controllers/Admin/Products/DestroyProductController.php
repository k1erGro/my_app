<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DestroyProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $product->propertyValues()->delete();
        foreach ($product->getReviews() as $review) {
            $review->delete();
        }
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
