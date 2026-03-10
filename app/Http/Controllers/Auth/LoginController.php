<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $auth = Auth::attempt([
            'email' => $request->string('email'),
            'password' => $request->string('password')
        ]);

        if (!$auth) {
            throw ValidationException::withMessages([
                'email' => ['Неверный адрес почты или пароль.'],
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('shop.index');
    }
}
