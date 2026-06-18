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
use Illuminate\Support\Facades\Log;
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
            'sub_category_id' => $request->integer('sub_category_id'),
        ]);

        $oldQuantities = AddressProduct::where('product_id', $product->getKey())
            ->pluck('product_quantity', 'address_id')
            ->toArray();

        $addressIds = $request->array('address_ids');
        $productQuantities = $request->array('product_quantities');

        $newQuantities = collect($addressIds)->combine($productQuantities)->toArray();

        $syncData = [];
        foreach ($newQuantities as $addressId => $productQuantity) {
            if (!empty($addressId)) {
                $syncData[$addressId] = ['product_quantity' => $productQuantity];
            }
        }
        $product->addresses()->sync($syncData);

        $subscribedUsers = $product->getSubscribedUsers();

        if ($subscribedUsers && $subscribedUsers->isNotEmpty()) {
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

        $properties = $request->array('properties');
        $propertyValues = $request->array('property_values');
        $propertiesValues = collect($properties)->combine($propertyValues)->toArray();

        $product->propertyValues()->delete();

        foreach ($propertiesValues as $propertyId => $propertyValue) {
            if (!empty($propertyId)) {
                $product->propertyValues()->create([
                    'property_id' => $propertyId,
                    'value' => $propertyValue,
                ]);
            }
        }

        if ($request->hasFile('product_image')) {
            $product->addMediaFromRequest('product_image')->toMediaCollection('products');
        }

        return redirect()->route('admin.product.index');
    }
}
