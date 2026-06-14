<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CancelOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $transaction = Transaction::where('order_id', $order->getKey())->firstOrFail();
        $transaction->delete();
        $order->delete();
        return redirect()->route('orders.index');
    }
}
