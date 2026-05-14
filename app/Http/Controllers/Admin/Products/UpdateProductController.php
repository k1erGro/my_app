<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\AddressProduct;
use App\Models\Product;
use App\Models\PropertyValue;
use App\Notifications\ArrivalNotification;
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

        $oldQuantities = AddressProduct::where('product_id', $product->getKey())
            ->pluck('product_quantity', 'address_id')
            ->toArray();

        $addressIds = $request->array('address_ids');
        $productQuantities = $request->array('product_quantities');
        $newQuantities = array_combine($addressIds, $productQuantities);


        $addressesProducts = array_combine($request->array('address_ids'), $request->array('product_quantities'));
        foreach ($addressesProducts as $addressId => $productQuantity) {
            $data[$addressId] = ['product_quantity' => $productQuantity];
        }
        $product->addresses()->sync($data);

        $subscribedUsers = $product->getSubscribedUsers();

        if ($subscribedUsers->isNotEmpty()) {
            foreach ($newQuantities as $addressId => $newQty) {
                $oldQty = $oldQuantities[$addressId] ?? 0;
                if ($oldQty == 0 && $newQty > 0) {
                    foreach ($subscribedUsers as $user) {
                        $user->notify(new ArrivalNotification($product));
                    }
                    break;
                }
            }
        }

        $properties_values = array_combine($request->array('properties'), $request->array('property_values'));
        $product->propertyValues()->delete();

        if (!empty($properties_values)) {
            foreach ($properties_values as $propertyId => $propertyValue) {
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
