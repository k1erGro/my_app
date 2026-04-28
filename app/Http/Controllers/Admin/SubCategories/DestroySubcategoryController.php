<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DestroySubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Subcategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('admin.subCategory.index');
    }
}
