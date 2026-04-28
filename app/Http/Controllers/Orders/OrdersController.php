<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::user()->getKey())->get();
        }
        else {
            $orders = collect();
        }
        return view('shop.orders.index', compact('orders'));
    }
}
