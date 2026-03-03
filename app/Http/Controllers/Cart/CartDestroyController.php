<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        }
        else{
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        if ($cart) {
            $cart->cartItems()->where('id', $id)->delete();
        }

        return redirect()->back();
    }
}
