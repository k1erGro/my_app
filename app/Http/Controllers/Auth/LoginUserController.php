<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();
        Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
}
