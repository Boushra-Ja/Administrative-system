<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Models\Bouns;
use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBounsRequest;

class BounsController extends Controller
{


    public function storeBouns(Request $request)

    {
        $valid = $request->validate([
            'points' => 'required ',
            'task_id' => 'required ',
        ]);

        $tt = Bouns::create([
            'points' => $valid['points'],
            'task_id' => $valid['task_id'],
        ]);

        $bouns_id =$tt['id'];
        $user_id = User::where('id' , Task::where('id' , $valid['task_id'])->value("user_id"))->value("id");

        User::where('id' , $user_id)->update([
            'points' => User::where('id' , $user_id)->value('points') + $valid['points']
        ]) ;

        broadcast(new NotificationEvent("رساله تحفيز",  "تم منحك بعض النقاط ",$user_id,$bouns_id));
        $realTime = Notification::create([
            'title' => "رساله تحفيز",
            'receiver_id' =>$user_id,
            'message' =>  "تم منحك بعض النقاط ",

        ]);
        $realTime->save();

        return response()->json([
            'message'=>'Bouns send successfully',
            'Task' => $tt,
        ]);


    }

    public function details_ِbouns($bouns_id)
    {

        $task_name = Task::where('id' , Bouns::where('id' ,$bouns_id )->value('task_id'))->value("title");
        $points=Bouns::where('id' ,$bouns_id )->value('task_id');

        return response()->json([
            'task_name'=> $task_name ,
            'points'=> $points,
        ]);

    }

}
