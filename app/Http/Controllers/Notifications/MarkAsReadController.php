<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkAsReadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $notification_id)
    {
        $notification = Auth::user()->notifications()->findOrFail($notification_id);
        $notification->markAsRead();
        return back();
    }
}
