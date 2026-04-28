<?php

namespace App\Http\Controllers\admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryRequest $request)
    {
        $category =  Category::create([
            'name' => $request->string('name'),
        ]);
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('category_images');
        }
        return redirect()->route('admin.category.index');
    }
}
