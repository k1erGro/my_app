<?php

namespace App\Http\Controllers\admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class EditCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }
}
