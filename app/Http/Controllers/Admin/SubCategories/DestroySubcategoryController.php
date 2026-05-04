<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DestroySubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Subcategory $subCategory)
    {
        try {
            $subCategory->delete();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при удалении. Возможно есть связанные данные');
        }
        return redirect()->route('admin.subCategory.index');
    }
}
