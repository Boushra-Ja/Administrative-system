<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\TaskkResource;
use App\Models\Appointment;
use App\Models\Child;
use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\Boshra\TaskResource;

class TaskController extends BaseController
{


    public function delete_appointment($id)
    {


        $AppModel = Task::query()->where('app_id','=',$id)
            ->where('check','=','0')->delete();
        $ap=Appointment::query()->where('id','=', $id)->delete();

        return response()->json([
            'message' =>"this appointment has deleted",
        ]);


    }




    public function Store_Task(Request $request)
    {
        $valid = $request->validate([
            'user_id' => 'required ',
            'app_id' => 'required ',
            'hours' => 'required ',
            'description' => 'required ',
            'title' => 'required ',
            'check' => 'required ',
            'notes' => 'required ',



        ]);

        $tt = Task::create([
            'user_id' => $valid['user_id'],
            'app_id' => $valid['app_id'],
            'hours' => $valid['hours'],
            'notes' => $valid['notes'],
            'description' => $valid['description'],
            'title' => $valid['title'],
            'check' => $valid['check'],

        ]);

        $task_id = Task::where('title' , $valid['title'])->value("id");
        $user_name = User::where('id' , $valid['user_id'])->value("name");

        broadcast(new NotificationEvent(" اسناد مهمه",  " تم اسناد مهه لك  ",$valid['user_id'],$task_id));
        $realTime = Notification::create([
            'title' => "اسناد مهمه",
            'receiver_id' =>$valid['user_id'],
            'message' => " {$user_name} تم اسناد مهه لك  ",

        ]);
        $realTime->save();

        return response()->json([
            'message'=>'A Task has been booked successfully',
            'Task' => $tt,
        ]);


    }

    public function show_MyTasks()
    {

        $Tasks= Task::where('user_id', '=', auth()->user()->id)->get();
        return response()->json($Tasks, 200);
    }

    public function show_MyTasks_id($id)
    {

        $task = Task::where('user_id', '=', $id)->get();
        return response()->json([
            'Task' => TaskkResource::collection($task),
        ]);
    }


    public function tasks_Employee($id)
    {
        $tasks= Task::where('user_id', '=', $id)
        ->where('check' , false)->get();

        if($tasks)
        {
            return $this->sendResponse(TaskResource::collection($tasks) , 'this is all tasks for you') ;
        }

        return $this->sendErrors([] , 'error in retrive your tasks') ;
    }

    public function finish_task($task_id , Request $request)
    {
        $task = Task::where('id' , $task_id);
        $update = $task->update([
            'check' => true ,
            'notes' => $request->notes

        ]) ;

        if($update)
        {    $task_name = Task::where('id' , $task_id)->value("title");

            broadcast(new NotificationEvent("انهاء مهمه",  "${task_name}  تم انهاء المهمه بنجاح ",1,$task_id));
            $realTime = Notification::create([
                'title' => "انهاء مهمه",
                'receiver_id' =>1,
                'message' => "${task_name}  تم انهاء المهمه بنجاح ",

            ]);

            $realTime->save();

            return $this->sendResponse($task , 'finish the task...');
        }

        return $this->sendErrors([ ] , 'error in the finish the task...') ;

    }

    public function update_Task(Request $request,$id)
    {
        $tt= Task::find($id);

        if($tt->check==0) {
            $tt->app_id=$request->app_id;
            $tt->user_id=$request->user_id;
            $tt->hours=$request->hours;
            $tt->description=$request->description;
            $tt->title=$request->title;

            $tt->save();
            return response()->json([
                'message'=>'This Task  edit successfully',
            ]);

        }
        else
            return response()->json([
                'message'=>'This Task cannot you edit',
            ]);


    }

    public function details_task($task_id )
    {

        //'user_name'=>User::where('id' , $this->user_id)->value('name'),

          $date_task=Appointment::where('id' , Task::where('id' , $task_id)->value('app_id'))->value('app_date');
          $title=Task::where('id' , $task_id)->value('title');
          $description= Task::where('id' , $task_id)->value('description');
          $hours=Task::where('id' , $task_id)->value('hours');
          $child_name=Child::where ( 'id',Appointment::where('id' , Task::where('id' , $task_id)->value('app_id'))->value('child_id'))->value('name');
          $child_section=Child::where ( 'id',Appointment::where('id' , Task::where('id' , $task_id)->value('app_id'))->value('child_id'))->value('section');


         $one= "تم اسناد مهمه لك بتاريخ ";
         $tow="وعنوانها ";
         $three=" ومحتواها هو ";
         $four=" وعليك انجازها بفتره معينه اقصاها";
         $five=" ساعه بدءا من وصولها اليك";
         $six="  اذ يتوجب عليك معاينه الطفل   ";
         $seven="  التابع للقسم ";

        return response()->json([
            'message'=>$one.$date_task.$tow.$title.$three.$description.$four.$hours.$five.$six.$child_name.$seven.$child_section,
        ]);


    }



    public function destroy(Task $task)
    {

    }
}
