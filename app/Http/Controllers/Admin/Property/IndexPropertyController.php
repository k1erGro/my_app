<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class IndexPropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $properties = Property::paginate(10);
        return view('admin.property.index', compact('properties'));
    }
}
