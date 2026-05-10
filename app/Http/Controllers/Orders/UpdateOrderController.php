<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Address;
use App\Models\AddressProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateOrderRequest $request, Order $order)
    {
        if ($order->getOrderProducts()->isEmpty()) {
            return back()->withErrors(['order' => 'Заказ не содержит товаров']);
        }
        if ($request->string('type_delivery') == 'pickup') {
            $warehouseId = $request->integer('warehouse_id');
            if (!$warehouseId) return back()->withErrors(['warehouse_id' => 'Выберите склад самовывоза']);
        } else {
            $warehouses = Address::where('is_warehouse', true)->get();
            $warehouseId = null;
            foreach ($warehouses as $warehouse) {
                $enough = true;
                foreach ($order->getOrderProducts() as $item) {
                    $available = AddressProduct::where('address_id', $warehouse->getKey())
                        ->where('product_id', $item->getProductId())
                        ->value('product_quantity') ?? 0;
                    if ($item->getQuantity() > $available) {
                        $enough = false;
                        break;
                    }
                }
                if ($enough) {
                    $warehouseId = $warehouse->getKey();
                    break;
                }
            }
            if (!$warehouseId) {
                return back()->withErrors(['delivery' => 'Нет склада, где есть все товары в нужном количестве']);
            }
        }

        $orderProducts = $order->getOrderProducts();
        if ($orderProducts->isEmpty()) {
            return back()->withErrors(['order' => 'Заказ не содержит товаров']);
        }

        DB::beginTransaction();
        try {
            foreach ($orderProducts as $item) {
                $addressProduct = AddressProduct::where('address_id', $warehouseId)
                    ->where('product_id', $item->getProductId())->first();

                $available = $addressProduct ? $addressProduct->getProductQuantity() : 0;

                if ($item->getQuantity() > $available) {
                    throw new \Exception("Товар «{$item->getProduct()->getName()}» доступен на складе в количестве {$available} шт. Вы заказали {$item->getQuantity()}.");
                }
            }

            foreach ($orderProducts as $item) {
                AddressProduct::where('address_id', $warehouseId)
                    ->where('product_id', $item->getProductId())
                    ->decrement('product_quantity', $item->getQuantity());
            }

            $addressId = null;
            if ($request->string('type_delivery') == 'pickup') {
                $addressId = $warehouseId;
            } else {
                if ($request->filled('saved_address_id')) {
                    $addressId = $request->integer('saved_address_id');
                } elseif ($request->filled('delivery_address')) {
                    $address = Address::create([
                        'name' => $request->string('delivery_address'),
                        'is_warehouse' => false,
                    ]);
                    $addressId = $address->getKey();
                }
            }

            $order->update([
                'address_id' => $addressId,
                'delivery_date' => $request->string('type_delivery') == 'delivery' ? $request->date('delivery_date') : null,
                'type_delivery' => $request->string('type_delivery'),
                'status' => 'in progress',
            ]);

            DB::commit();

            return redirect()->route('orders.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['stock' => $e->getMessage()]);
        }
    }
}
