<?php

namespace App\Http\Controllers\Admin\SubCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class UpdateSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update([
            'name' => $request->string('name'),
            'category_id' => $request->integer('category_id'),
        ]);
        if ($request->hasFile('image')) {
            $subCategory->clearMediaCollection('subCategory_images')->addMediaFromRequest('image')->toMediaCollection('subCategory_images');
        }
        return redirect(route('admin.subCategory.index'));
    }
}
