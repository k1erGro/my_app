<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UpdateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $order->update([
            'address' => $request->string('address'),
            'delivery_date' => $request->date('delivery_date'),
            'status' => 'in progress',
        ]);
        return redirect()->route('admin.orders.index');
    }
}
