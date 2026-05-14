<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
}
