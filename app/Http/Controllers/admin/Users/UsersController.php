<?php

namespace App\Http\Controllers\admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }
}
