<?php

namespace App\Http\Controllers\Favourites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreFavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Favorite::create([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $request->integer('product_id'),
        ]);

        return redirect()->back()->with('message', 'Товар добавлен в избранное!');
    }
}
