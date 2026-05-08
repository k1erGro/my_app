<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EditOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $warehouses = Address::where('is_warehouse', true)->get();
        $usedAddresses = Address::where('is_warehouse', false)->whereHas('orders', function ($query){
            $query->where('user_id', Auth::user()->getKey());
        })->distinct()->get();

        return view('shop.orders.edit', compact('order', 'warehouses', 'usedAddresses'));
    }
}
