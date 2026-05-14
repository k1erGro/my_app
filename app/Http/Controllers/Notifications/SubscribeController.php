<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        if ($request->integer('is_subscribed') == 1) {
            $user->update(['is_subscribed' => true]);
        } else {
            $user->update(['is_subscribed' => false]);
        }

        return back()->with('success', 'Вы подписаны на рассылку');
    }
}
