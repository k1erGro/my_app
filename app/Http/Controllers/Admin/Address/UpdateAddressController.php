<?php

namespace App\Http\Controllers\Admin\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class UpdateAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddressRequest $request, Address $address)
    {
        $address->update([
            'name' => $request->string('name'),
        ]);

        return redirect()->route('admin.address.index');
    }
}
