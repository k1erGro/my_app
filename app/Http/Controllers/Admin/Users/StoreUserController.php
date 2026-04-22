<?php

namespace App\Http\Controllers\admin\Users;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Models\User;

class StoreUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $users = User::create([
            'f_name' => $request->string('f_name'),
            'l_name' => $request->string('l_name'),
            'm_name' => $request->string('m_name'),
            'email' => $request->string('email'),
            'password' => $request->string('password'),
            'avatar' => $request->file('avatar'),
            'birthday' => $request->date('birthday'),
            'phone' => $request->string('phone'),
            'address' => $request->string('address'),
        ])->assignRole(RoleEnum::USER);
        if ($request->hasFile('avatar')) {
            $users->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        return redirect()->route('admin.index');
    }
}
