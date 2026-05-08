<?php

namespace App\Http\Controllers\Admin\Address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DeleteAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Address $address)
    {
        try {
            $address->delete();
        } catch (QueryException) {
            return redirect()->back()->with('error', 'Произошла ошибка при удалении. Возможно есть связанные данные');
        }

        return redirect()->route('admin.address.index');
    }
}
