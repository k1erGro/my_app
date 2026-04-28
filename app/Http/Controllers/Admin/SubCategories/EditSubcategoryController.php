<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class EditSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }
}
