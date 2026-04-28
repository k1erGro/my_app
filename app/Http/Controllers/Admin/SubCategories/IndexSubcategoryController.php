<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class IndexSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $subСategories = SubCategory::paginate(10);
        return view('admin.subCategory.index', compact('subСategories'));
    }
}
