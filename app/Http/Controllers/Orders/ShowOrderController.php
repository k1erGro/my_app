<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        return view('shop.orders.show', compact('order'));
    }
}
