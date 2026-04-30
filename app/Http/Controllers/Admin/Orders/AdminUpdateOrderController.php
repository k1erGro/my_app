<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AdminOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminUpdateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdminOrderRequest $request, Order $order)
    {
        $order->update([
            'delivery_date' => $request->date('delivery_date'),
            'address_id' => $request->integer('address_id'),
            'status' => $request->string('status'),
        ]);

        return redirect()->route('admin.orders.index');
    }
}
