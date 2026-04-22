<?php

namespace App\Http\Controllers\admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->string('name'),
            'slug' => Str::slug($request->string('name')),
            'parent_id' => $request->integer('parent_id') == 0 ? null : $request->integer('parent_id'),
        ]);
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('category_images')->addMediaFromRequest('image')->toMediaCollection('category_images');
        }
        return redirect()->route('admin.category.index');
    }
}
