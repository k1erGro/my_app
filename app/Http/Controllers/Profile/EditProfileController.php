<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        if ($request->getRequestUri() == '/profile/edit/' . Auth::id()) {
            return view('profile.edit');
        } elseif ($request->getRequestUri() == '/profile/edit-password/' . Auth::id()) {
            return view('profile.edit_password');
        }

    }
}
