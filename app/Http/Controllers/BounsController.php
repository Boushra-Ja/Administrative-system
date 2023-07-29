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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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


        $one= "تم منحك  ";
        $tow="  نقاط وذلك لاتقانك للمهمه  ";
        $three=" حيث وصلنا نتائج مرضيه من الاهل ";


        return response()->json([
            'message'=>$one.$points.$tow.$task_name.$three,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(Bouns $bouns)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bouns $bouns)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBounsRequest $request, Bouns $bouns)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bouns $bouns)
    {
        //
    }
}
