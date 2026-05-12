<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeletePropertyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Property $property)
    {
        try {
            DB::transaction(function () use ($request, $property) {
                $property->delete();
            });
            return back()->with('success', 'Характеристика успешно удалена');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
