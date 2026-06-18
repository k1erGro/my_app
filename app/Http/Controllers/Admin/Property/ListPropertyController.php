<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class ListPropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = Property::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $properties = $query->paginate(10);
        $properties->appends($request->only('search'));

        return view('admin.property.index', compact('properties'));



        $properties = Property::paginate(10);
        return view('admin.property.index', compact('properties'));
    }
}
