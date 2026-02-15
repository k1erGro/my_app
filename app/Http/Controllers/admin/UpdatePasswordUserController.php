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
        $password = $request->string('password');
        $userData = [
            'password' => Hash::make($password),
        ];
        $user->update($userData);

        return redirect()->route('admin.index');
    }
}
