<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $order->update([
            'address_id' => $request->string('address_id'),
            'delivery_date' => $request->date('delivery_date'),
            'status' => 'in progress',
        ]);
        return Auth::user()->hasRole('Admin') ? redirect()->route('admin.orders.index'): redirect()->route('orders.index');
    }
}
