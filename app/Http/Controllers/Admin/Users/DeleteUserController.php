<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DeleteUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $this->authorize('delete', $user);
        DB::transaction(function () use ($user) {
            foreach ($user->getReviews() as $review) {
                $review->delete();
            }
            $user->delete();
        });
        return Auth::user()->getAuthIdentifier() !== $user->getKey() ? redirect()->route('admin.index') : redirect()->route('show.login');
    }
}
