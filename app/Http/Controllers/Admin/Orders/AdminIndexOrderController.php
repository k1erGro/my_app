<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminIndexOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $orders = Order::paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
}
