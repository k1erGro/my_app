<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    function register(){
        return view('auth.register');
    }
    function registerPost(RegisterRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Вы успешно зарегистрированы!');
    }
    function login(){
        return view('auth.login');
    }
    function loginPost(LoginRequest $request){
        $data = $request->validated();
        Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
    function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    function dashboard(){
        return view('dashboard');
    }
}
