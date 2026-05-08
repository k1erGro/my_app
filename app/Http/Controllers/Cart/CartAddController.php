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
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cartItem = $cart->cartItems()->where('product_id', $data['product_id'])->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->cartItems()->create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'] ?? 1,
            ]);
        }

        return redirect()->back();
    }
}
