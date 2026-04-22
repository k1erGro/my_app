<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $specs = [];
        $keys = $request->input('specs_keys', []);
        $values = $request->input('specs_values', []);

        foreach ($keys as $index => $key) {
            if (!empty($key)){
                $specs[$key] = $values[$index] ?? '';
            }
        }

        $product = Product::create([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'price' => $request->string('price'),
            'description' => $request->string('description'),
            'specs' => $specs,
        ]);
        $product->categories()->attach($request->integer('category_id'));

        if ($request->hasFile('product_image')) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('products');
        }
        return redirect()->route('admin.product.index');

    }
}
