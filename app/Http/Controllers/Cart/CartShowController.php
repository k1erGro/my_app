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
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->with(['cartItems.product'])->first();
        }
        else {
            $cart = Cart::where('session_id', $request->session()->getId())->with(['cartItems.product'])->first();
        }

        $items = $cart ? $cart->cartItems : collect();

        return view('shop.cart.show', compact('items', 'cart'));
    }
}
