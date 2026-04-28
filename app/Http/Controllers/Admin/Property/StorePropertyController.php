<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\PropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class StorePropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PropertyRequest $request)
    {
        Property::create([
            'name' => $request->string('name'),
        ]);
        return redirect()->route('admin.property.index');
    }
}
