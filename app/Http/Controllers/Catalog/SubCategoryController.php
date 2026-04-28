<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Category $category)
    {
        return view('shop.category.subCatalog', compact('category'));
    }
}
