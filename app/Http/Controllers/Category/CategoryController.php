<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Category $category = null)
    {
        $products = null;
        $categories = null;
        if ($category) {
            if($category->children()->exists()) {
                $categories = $category->children()->with('media')->get();
                $title = $category->getName();
            }
            else {
                $products = $category->products()->paginate(8);
                $title = 'Товары категории ' . $category->getName();
            }
        }
        else {
            $categories = Category::whereNull('parent_id')->with('media')->get();
            $title = 'Каталог товаров';
        }

        return view('shop.category.catalog', compact('categories', 'title', 'products'));
    }
}
