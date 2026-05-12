<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Address;
use App\Models\AddressProduct;
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
    public function __invoke(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $cart = $user->getCart();
        if (!$cart || $cart->getCartItems()->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Корзина пуста');
        }

        if (filled($request->cart_item_id)) {
            $cart_item = $user
                        ->getCart()
                        ->getCartItems()
                        ->where('id', $request->integer('cart_item_id'))
                        ->first();
            $order = Order::create([
                'user_id' => $user->getKey(),
                'total_price' => $request->integer('price') * $request->integer('quantity'),
            ]);

            OrderProduct::create([
                'order_id' => $order->getKey(),
                'product_id' => $cart_item->getProduct()->getKey(),
                'quantity' => $cart_item->getQuantity(),
                'price' => $cart_item->getProduct()->getPrice(),
            ]);

            $cart_item->delete();

        } else {
            $totalPrice = array_sum(array_map(function ($quantity, $price) {
                return $quantity * $price;
            }, $request->input('quantity'), $request->input('price')));
            $cart = $user->getCart();

            $order = Order::create([
                'user_id' => $user->getKey(),
                'total_price' => $totalPrice,
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
        }

        return redirect()->route('orders.edit', compact('order'));
    }
}
