<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {

        $this->authorize('update', $user);
        $password = $request->string('password');
        $userData = [
            'f_name' => $request->string('f_name'),
            'l_name' => $request->string('l_name'),
            'm_name' => $request->string('m_name'),
            'email' => $request->string('email'),
            'password' => Hash::make($password),
            'avatar' => $request->file('avatar'),
            'birthday' => $request->date('birthday'),
            'phone' => $request->string('phone'),
            'address' => $request->string('address'),
            'role' => $request->string('role'),
        ];
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars')->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        $user->update($userData);
        return redirect()->route('admin.index');
    }
}
