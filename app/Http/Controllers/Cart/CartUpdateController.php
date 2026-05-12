<?php

namespace App\Http\Controllers\Cart;

use App\Enums\ActionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCartRequest $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $item = $cart->cartItems()->where('id', $id)->first();
            if ($item) {
                if($request->integer('action') == ActionEnum::MINUS->value && $item->quantity > 1)
                {
                    $item->decrement('quantity');
                }
                elseif ($request->integer('action') == ActionEnum::PLUS->value)
                {
                    $item->increment('quantity');
                }
            }
        }

        return redirect()->back();
    }
}
