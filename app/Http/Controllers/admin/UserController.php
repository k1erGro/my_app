<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['phone'] = auth()->user()->setNumberAttribute($data['phone']);
        $users = User::create($data);
        if ($request->hasFile('avatar')) {
            $users->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return redirect()->route('admin.index');
    }

    public function show(User $user)
    {
        return view('admin.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars')->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('admin.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index');
    }
}
