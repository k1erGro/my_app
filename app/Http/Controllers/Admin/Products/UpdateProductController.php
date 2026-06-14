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
        // Исправлена опечатка с русской 'с' и приведен ключ к sub_category_id
        $product->update([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'price' => $request->string('price'),
            'description' => $request->string('description'),
            'category_id' => $request->integer('category_id'),
            'sub_category_id' => $request->integer('sub_category_id'),
        ]);

        // Получаем старое количество ДО синхронизации
        $oldQuantities = AddressProduct::where('product_id', $product->getKey())
            ->pluck('product_quantity', 'address_id')
            ->toArray();

        $addressIds = $request->array('address_ids');
        $productQuantities = $request->array('product_quantities');

        // Безопасное объединение массивов через коллекции Laravel
        $newQuantities = collect($addressIds)->combine($productQuantities)->toArray();

        // Формируем данные для синхронизации pivot-таблицы
        $syncData = [];
        foreach ($newQuantities as $addressId => $productQuantity) {
            if (!empty($addressId)) {
                $syncData[$addressId] = ['product_quantity' => $productQuantity];
            }
        }
        $product->addresses()->sync($syncData);

        // Логика отправки уведомлений о поступлении
        $subscribedUsers = $product->getSubscribedUsers();

        Log::info('--- СТАРТ ОТЛАДКИ УВЕДОМЛЕНИЙ ---');
        Log::info('ID товара: ' . $product->id);
        Log::info('Старые количества на складах:', $oldQuantities);
        Log::info('Новые количества из запроса:', $newQuantities);

        $subscribedUsers = $product->getSubscribedUsers();
        Log::info('Количество подписанных пользователей: ' . ($subscribedUsers ? $subscribedUsers->count() : 0));

        foreach ($newQuantities as $addressId => $newQty) {
            $oldQty = $oldQuantities[$addressId] ?? 0;
            Log::info("Проверка склада ID {$addressId}: Старое qty = {$oldQty}, Новое qty = {$newQty}");

            if ($oldQty == 0 && $newQty > 0) {
                Log::info('УСЛОВИЕ СРАБОТАЛО! Пытаемся отправить уведомление...');
            }
        }
        Log::info('--- КОНЕЦ ОТЛАДКИ ---');

        if ($subscribedUsers && $subscribedUsers->isNotEmpty()) {
            foreach ($newQuantities as $addressId => $newQty) {
                $oldQty = $oldQuantities[$addressId] ?? 0;

                // Если товара не было на этом складе, а теперь он появился
                if ($oldQty == 0 && $newQty > 0) {
                    foreach ($subscribedUsers as $user) {
                        $user->notify(new ArrivalNotification($product));
                    }
                    // Уведомление отправлено, выходим из цикла складов, чтобы не дублировать
                    break;
                }
            }
        }

        // Обновление характеристик
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
