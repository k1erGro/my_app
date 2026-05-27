<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartAddController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddCartRequest $request)
    {
        $productId = $request->integer('product_id');

        $product = Product::with('addresses')->find($productId);

        if (!$product || $product->addresses->isEmpty()) {
            return redirect()->back()->with('error', 'Товара нет в наличии!');
        }

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $request->integer('quantity', 1),
            ]);
        }

        return redirect()->back()->with('message', 'Товар успешно добавлен в корзину!');
    }
}
