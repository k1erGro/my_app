<?php

namespace App\Http\Controllers\admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestroyCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Произошла ошибка при удалении. Возможно есть связанные данные');
        }

        return redirect()->back();
    }
}
