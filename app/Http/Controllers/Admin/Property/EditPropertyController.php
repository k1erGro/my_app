<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class EditPropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Property $property)
    {
        return view('admin.property.edit', compact('property'));
    }
}
