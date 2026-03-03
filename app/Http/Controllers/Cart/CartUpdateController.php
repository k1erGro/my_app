<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $data = $request->validate([
            'action' => 'required|in:plus,minus',
        ]);
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        }
        else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        if ($cart) {
            $item = $cart->cartItems()->where('id', $id)->first();
            if ($item) {
                if($data['action'] === 'minus' && $item->quantity > 1)
                {
                    $item->decrement('quantity');
                }
                elseif ($data['action'] === 'plus')
                {
                    $item->increment('quantity');
                }
            }
        }

        return redirect()->back();
    }
}
