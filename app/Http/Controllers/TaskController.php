<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\TaskkResource;
use App\Models\Appointment;
use App\Models\Task;
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



        ]);

        $tt = Task::create([
            'user_id' => $valid['user_id'],
            'app_id' => $valid['app_id'],
            'hours' => $valid['hours'],
            'description' => $valid['description'],
            'title' => $valid['title'],
            'check' => $valid['check'],

        ]);
// $result = (new  ViewController)->Store_row();

        //dd($result) ;

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
        {
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


    public function destroy(Task $task)
    {

    }
}
