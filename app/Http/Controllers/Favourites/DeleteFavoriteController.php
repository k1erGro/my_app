<?php

namespace App\Http\Controllers\Favourites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class DeleteFavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Favorite $favorite)
    {
        $favorite->delete();
        return redirect()->route('favourites.list');
    }
}
