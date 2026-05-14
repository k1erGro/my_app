<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowNotification extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($notification)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($notification);
        return view('shop.notifications.show', compact('notification', 'user'));
    }
}
