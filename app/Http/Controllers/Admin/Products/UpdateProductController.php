<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UpdateProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'price' => $request->string('price'),
            'description' => $request->string('description'),
            'category_id' => $request->integer('category_id'),
            'sub_сategory_id' => $request->integer('subCategory_id'),
        ]);


        $data = array_combine($request->array('properties'), $request->array('property_values'));

        $product->propertyValues()->delete();

        if (!empty($data)) {
            foreach ($data as $propertyId => $propertyValue) {
                $product->propertyValues()->create(
                    [
                        'property_id' => $propertyId,
                        'value' => $propertyValue,
                    ]
                );
            }
        }
        if ($request->hasFile('product_image')) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('products');
        }
        return redirect()->route('admin.product.index');
    }
}
