<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);

        return redirect()->route('admin.index');
    }
}
