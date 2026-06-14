<?php

namespace App\Http\Controllers\Admin\Address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class ListAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $addresses = Address::where('is_warehouse', 1)->paginate(10);
        return view('admin.address.index', compact('addresses'));
    }
}
