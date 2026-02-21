<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        Auth::attempt([
            'email' => $request->string('email'),
            'password' => $request->string('password')
        ]);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
}
