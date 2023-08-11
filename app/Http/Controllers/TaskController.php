<?php
///INSERT INTO `children` (`id`, `name`, `age`, `phone_num`, `infection`, `section`, `password`, `created_at`, `updated_at`, `deleted_at`, `unique_number`) VALUES ('1', 'nnn', '11', '444', 'kmkmlkm', 'lkkm', '000', '2023-08-15 18:06:54', NULL, NULL, '111');
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


        $AppModel = Task::query()->where('app_id', '=', $id)
            ->where('check', '=', '0')->delete();
        $ap = Appointment::query()->where('id', '=', $id)->delete();

        return response()->json([
            'message' => "this appointment has deleted",
        ]);
    }


    public function checkTask($userid, $start, $date, $hours, $new)
    {

        $h = [];

        $id = Task::where('user_id', '=', $userid)
            ->where('check', '=', 0)->value('id');


        $mdate =   Appointment::where('id', '=', Task::where('user_id', '=', $userid)
            ->where('check', '=', 0)->value('app_id'))->value('app_date');
        if ($mdate == $date) {
            $h = $start + $hours;

            if ($h > 12)
                $g = $h - 12;


            //  if(<$start<)

        }
    }

    public function Store_Task(Request $request)
    {
        $valid = $request->validate([
            'user_id' => 'required ',
            'app_id' => 'required ',
            'hours' => 'required ',
            'start' => 'required ',
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
            'start' => $valid['start'],
            'check' => $valid['check'],

        ]);

        $task_id = Task::where('title', $valid['title'])->value("id");
        $user_name = User::where('id', $valid['user_id'])->value("name");

        broadcast(new NotificationEvent(" اسناد مهمه",  " تم اسناد مهه لك  ", $valid['user_id'], $task_id));
        $realTime = Notification::create([
            'title' => "اسناد مهمه",
            'receiver_id' => $valid['user_id'],
            'message' => " {$user_name} تم اسناد مهه لك  ",

        ]);
        $realTime->save();

        return response()->json([
            'message' => 'A Task has been booked successfully',
            'Task' => $tt,
        ]);
    }

    public function show_MyTasks()
    {

        $Tasks = Task::where('user_id', '=', auth()->user()->id)->get();
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
        $tasks = Task::where('user_id', '=', $id)
            ->where('check', false)->get();

        if ($tasks) {
            return $this->sendResponse(TaskResource::collection($tasks), 'this is all tasks for you');
        }

        return $this->sendErrors([], 'error in retrive your tasks');
    }

    public function finish_task($task_id, Request $request)
    {
        $task = Task::where('id', $task_id);
        $update = $task->update([
            'check' => true,
            'notes' => $request->notes

        ]);

        if ($update) {
            $task_name = Task::where('id', $task_id)->value("title");

            broadcast(new NotificationEvent("انهاء مهمه",  "${task_name}  تم انهاء المهمه بنجاح ", 1, $task_id));
            $realTime = Notification::create([
                'title' => "انهاء مهمه",
                'receiver_id' => 1,
                'message' => "${task_name}  تم انهاء المهمه بنجاح ",

            ]);

            $realTime->save();

            return $this->sendResponse($task, 'finish the task...');
        }

        return $this->sendErrors([], 'error in the finish the task...');
    }

    public function update_Task(Request $request, $id)
    {
        $tt = Task::find($id);

        if ($tt->check == 0) {
            $tt->app_id = $request->app_id;
            $tt->user_id = $request->user_id;
            $tt->hours = $request->hours;
            $tt->description = $request->description;
            $tt->title = $request->title;

            $tt->save();
            return response()->json([
                'message' => 'This Task  edit successfully',
            ]);
        } else
            return response()->json([
                'message' => 'This Task cannot you edit',
            ]);
    }



    public function details_task($task_id)
    {

        $task = Task::where('id' , $task_id)->first() ;
        return $this->sendResponse(new TaskkResource($task) , 'success');

    }


}
