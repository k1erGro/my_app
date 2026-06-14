<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomePageController extends Controller
{
    public function welcome()
    {
        $categories = Category::with('media')->limit(4)->get();
        return view('shop.welcome', compact('categories'));
    }
}
