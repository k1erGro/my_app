<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                $product->propertyValues()->delete();
                foreach ($product->getReviews() as $review) {
                    $review->delete();
                }
                $product->delete();
            });
            return back()->with('success', 'Товар успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
