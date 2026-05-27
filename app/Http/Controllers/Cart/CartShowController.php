<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart = $cart->fresh(['cartItems.product']);

            $items = $cart->cartItems;

            foreach ($items as $item) {
                if (!$item->product) {
                    $item->delete();
                }
            }

            $items = $cart->cartItems()->with('product')->get();
        } else {
            $items = collect();
        }

        return view('shop.cart.show', compact('items', 'cart'));
    }
}
