<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, UpdatePasswordRequest $request)
    {
        $this->authorize('update', $user);
        $user->update(['password' => $request->string('password')]);

        return redirect()->route('admin.index');
    }
}
