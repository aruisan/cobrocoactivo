<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index',[

            'unreadNotifications' =>  auth()->user()->unreadNotifications,
            'readNotifications' =>  auth()->user()->readNotifications,
            'notifications' =>  auth()->user()->notifications->where('visibility', 1),

        ]);
    }

    public function read($id)
    {   
        
        DatabaseNotification::find($id)->markAsRead();

        return back();
    }

    public function destroy($id)
    {
        DatabaseNotification::find($id)->delete();

        return back();
    }    


    public function visibilidad($id)
    {
        $notification = DatabaseNotification::find($id);

        $notification->visibility = false;

        $notification->save();

        return back();
    }
}
