<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartAddController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (empty($request->input('addresses'))) {
            return redirect()->back()->with('error', 'Товара нет в наличии!');
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cartItem = $cart->cartItems()->where('product_id', $request->integer('product_id'))->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->cartItems()->create([
                'product_id' => $request->integer('product_id'),
                'quantity' => $request->integer('quantity') ?? 1,
            ]);
        }

        return redirect()->back();
    }
}
