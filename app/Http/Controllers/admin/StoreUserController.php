<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $users = User::create($data);
        if ($request->hasFile('avatar')) {
            $users->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return redirect()->route('admin.index');
    }
}
