<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestroyUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return Auth::user()->getAuthIdentifier() !== $user->getKey() ? redirect()->route('admin.index') : redirect()->route('register');
    }
}
