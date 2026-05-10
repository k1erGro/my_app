<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.main', function ($view) {
            $cartCount = 0;

            if (Auth::user()) {
                $cart = Cart::where('user_id', Auth::id())->with('cartItems')->first();
                if ($cart) {
                    $cartCount = $cart->cartItems->sum('quantity');
                }
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
