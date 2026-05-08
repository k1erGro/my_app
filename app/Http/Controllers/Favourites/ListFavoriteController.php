<?php

namespace App\Http\Controllers\Favourites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListFavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $favourites = Favorite::where('user_id', Auth::user()->getKey())->paginate(10);
        return view('shop.favourites.list', compact('favourites'));
    }
}
