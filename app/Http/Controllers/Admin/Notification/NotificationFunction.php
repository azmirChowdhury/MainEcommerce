<?php

namespace App\Http\Controllers\admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\All_notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NotificationFunction extends Controller
{


    private function insert_notification($type,$data,$messageId)
    {
        $notification = new All_notifications();
        $notification->notifiable_type =$type;
        $notification->notifiable_id=$messageId;
        $notification->data=$data;
        return $notification;
    }

    private function randomId()
    {
        $id = Auth::user()->id;
        return $id;
    }
    public function notification($type,$data,$messageId)
    {
        $notification = $this->insert_notification($type,$data,$messageId);
        $notification->save();
    }

}
