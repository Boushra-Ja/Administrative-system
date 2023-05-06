<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AppMiddleware;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{



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
