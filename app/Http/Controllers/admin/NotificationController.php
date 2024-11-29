<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Notification;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        $notifications = Notification::where('user_id_noti', 1)  // ID admin
            ->where('status', 'Unread')
            ->get();

            return view('admin.template.dashboard', compact('notifications'));
    }
    
    public function markNotificationAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->status = 'Read';
            $notification->save();
        }

        return redirect()->back();
    }
}
