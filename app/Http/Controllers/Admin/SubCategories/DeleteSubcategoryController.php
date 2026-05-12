<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Subcategory $subCategory)
    {
        try {
            $subCategory->delete();
            return back()->with('success', 'Подкатегория успешно удалена');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
