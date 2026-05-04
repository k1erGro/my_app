<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DestroyPropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Property $property)
    {
        try {
            $property->delete();
        } catch (QueryException) {
            return redirect()->back()->with('error', 'Произошла ошибка при удалении. Возможно есть связанные данные');
        }

        return redirect()->route('admin.property.index');
    }
}
