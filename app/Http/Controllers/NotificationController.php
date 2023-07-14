<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function alert(Request $request)
    {

        $message = $request->message;
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $title = $request->title;

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

        broadcast(new NotificationEvent($message, $receiver_id, $title));


        return $realTime;
    }

    // bayan
    public static function alertBayan($message, $sender_id, $receiver_id, $title)
    {


        $realTime = Notification::create([
            'title' => $title,
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,

        ]);

        $realTime->save();

        broadcast(new NotificationEvent($message, $receiver_id, $title));


        return $realTime;
    }

}
