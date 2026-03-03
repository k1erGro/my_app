<?php

namespace App\Http\Controllers\admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
}
