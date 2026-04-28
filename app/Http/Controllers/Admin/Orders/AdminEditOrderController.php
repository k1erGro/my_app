<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminEditOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $addresses = Address::all();
        return view('admin.orders.edit', compact('order', 'addresses'));
    }
}
