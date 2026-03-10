<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProductRequest $request, Product $product)
    {
        $specs = [];
        $keys = $request->input('specs_keys', []);
        $values = $request->input('specs_values', []);

        foreach ($keys as $index => $key) {
            if (!empty($key)){
                $specs[$key] = $values[$index] ?? '';
            }
        }

        $product->update([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'price' => $request->string('price'),
            'description' => $request->string('description'),
            'category_id' => $request->integer('category_id'),
            'specs' => $specs,
        ]);
        if ($request->hasFile('product_image')) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('products');
        }
        return redirect()->back();
    }
}
