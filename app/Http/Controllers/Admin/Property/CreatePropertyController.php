<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatePropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.property.create');
    }
}
