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
            'status' => $request->string('status'),
        ]);

        return redirect()->route('admin.orders.index');
    }
}
