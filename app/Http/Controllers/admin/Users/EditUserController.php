<?php

namespace App\Http\Controllers\admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        if ($request->getRequestUri() == '/admin/edit/' . $user->getKey()) {
            return view('admin.user.edit', compact('user'));
        } elseif($request->getRequestUri() == '/admin/edit_password/' . $user->getKey()) {
            return view('admin.user.edit_password', compact('user'));
        }
    }
}
