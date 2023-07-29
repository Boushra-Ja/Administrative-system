<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Http\Controllers\API\BaseController;
use App\Models\ChildNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{

    public function alert(Request $request)
    {


        $valid = $request->validate([
            'title' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        $realTime = Notification::create([
            'title' => $valid['title'],
            'sender_id' => $valid['sender_id'],
            'receiver_id' => $valid['receiver_id'],
            'message' => $valid['message'],

        ]);

        $realTime->save();

       // broadcast(new NotificationEvent($message, $receiver_id, $title,9));


        return $realTime;
    }

    public function all_parent_notifications($child_id) {
        $notifications = ChildNotification::where('receiver_id' , $child_id)->get() ;
        return $this->sendResponse($notifications , 'success in get all notifications') ;

    }

    public function all_employee_notifications($emp_id) {

        $notifications = Notification::where('receiver_id' , $emp_id)->get() ;
        return $this->sendResponse($notifications , 'success in get all notifications') ;
    }
    public function all_admin_notifications($admin_id) {

        $notifications = Notification::where('receiver_id' , $admin_id)->get() ;
        return $this->sendResponse($notifications , 'success in get all notifications') ;
    }
}
