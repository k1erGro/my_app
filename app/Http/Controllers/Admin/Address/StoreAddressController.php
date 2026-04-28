<?php

namespace App\Http\Controllers\Admin\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class StoreAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddressRequest $request)
    {
        Address::create([
           'name' => $request->string('name'),
        ]);
        return redirect()->route('admin.address.index');
    }
}
