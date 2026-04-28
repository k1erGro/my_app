<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class DestroyPropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Property $property)
    {
        $property->delete();
        return redirect()->route('admin.property.index');
    }
}
