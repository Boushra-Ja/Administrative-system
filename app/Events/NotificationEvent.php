<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_id;
    public $title;
    public $id;

    public function __construct($title,$message,$receiver_id,$id)
    {
        $this->message=$message;
        $this->receiver_id=$receiver_id;
        $this->title=$title;
        $this->id=$id;
    }


    public function broadcastOn()
    {
        return new Channel('public-channel.'.$this->receiver_id);
    }

//    public function  broadcastAs() :String{
//
//        return 'NotificationEvent';
//    }

    public function broadcastAs() {

        return 'NotificationEvent';

    }


}
