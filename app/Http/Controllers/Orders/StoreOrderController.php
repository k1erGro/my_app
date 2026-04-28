<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(OrderRequest $request)
    {
        $addresses = Address::all();
        $total_price = array_sum(array_map(function ($quantity, $price) { return $quantity * $price; }, $request->input('quantity'), $request->input('price')));
        $cart = Auth::user()->getCart();

        $order = Order::create([
            'user_id' => Auth::user()->getKey(),
            'total_price' => $total_price,
            'address_id' => 1,
        ]);


        foreach ($cart->getCartItems() as $orders_products) {
            OrderProduct::create([
                'order_id' => $order->getKey(),
                'product_id' => $orders_products->getProduct()->getKey(),
                'quantity' => $orders_products->getQuantity(),
                'price' => $orders_products->getProduct()->getPrice(),
            ]);
        }

        $cart->delete();


        return view('shop.orders.create', compact('order', 'total_price', 'addresses'));
    }
}
