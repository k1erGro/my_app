<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars')->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        $user->update($data);
        return redirect()->route('admin.index');
    }
}
