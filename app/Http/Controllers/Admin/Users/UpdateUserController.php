<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $authenticated_user = Auth::user();
        $data = $request->validated();
        if ($authenticated_user)
            if ($authenticated_user->hasRole(RoleEnum::ADMIN)) {
                $user->syncRoles($request->role);

            }
            else {
                $user->update([
                    'f_name' => $data['f_name'],
                    'l_name' => $data['l_name'],
                    'm_name' => $data['m_name'] ?? null,
                    'email' => $data['email'],
                    'birthday' => $data['birthday'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'address' => $data['address'] ?? null,
                ]);

                if ($request->hasFile('avatar')) {
                    $user->clearMediaCollection('avatars');
                    $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
                }
            }

        return redirect()->back()->with('success', 'Профиль успешно обновлен!');
    }
}
