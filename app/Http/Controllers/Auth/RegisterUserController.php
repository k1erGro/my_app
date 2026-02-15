<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
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
        ];
        $user = User::create($userData);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Вы успешно зарегистрированы!');
    }
}
