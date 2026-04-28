<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        return view('admin.subCategory.create', compact('categories'));
    }
}
