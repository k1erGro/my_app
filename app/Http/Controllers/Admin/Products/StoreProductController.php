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
        $product = Product::create([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'price' => $request->string('price'),
            'description' => $request->string('description'),
            'category_id' => $request->integer('category_id'),
            'sub_category_id' => $request->integer('sub_category_id'),
        ]);

        $addressesProducts = array_combine($request->array('address_ids'), $request->array('product_quantities'));
        foreach ($addressesProducts as $addressId => $productQuantity) {
            $data[$addressId] = ['product_quantity' => $productQuantity];
        }
        $product->addresses()->sync($data);

        $data = array_combine($request->array('properties'), $request->array('property_values'));

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
