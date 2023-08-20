<?php
///INSERT INTO `children` (`id`, `name`, `age`, `phone_num`, `infection`, `section`, `password`, `created_at`, `updated_at`, `deleted_at`, `unique_number`) VALUES ('1', 'nnn', '11', '444', 'kmkmlkm', 'lkkm', '000', '2023-08-15 18:06:54', NULL, NULL, '111');
namespace App\Http\Controllers;
///INSERT INTO `tasks` (`id`, `hours`, `start`, `description`, `title`, `check`, `notes`, `user_id`, `app_id`, `created_at`, `updated_at`) VALUES ('1', '3', '10', 'nnnn', 'nnn', '0', NULL, '3', '1', '2023-08-15 03:25:30', NULL);
use App\Events\NotificationEvent;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\TaskkResource;
use App\Models\Appointment;
use App\Models\Child;
use App\Models\ChildNotification;
use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Boshra\TaskResource;
use Illuminate\Support\Facades\DB;

class TaskController extends BaseController
{


    public function delete_appointment($id)
    {

        $idtask = Task::query()->where('app_id', '=', $id)
            ->where('check', '=', '0')->value('id');
        $user_id = Task::query()->where('app_id', '=', $id)
            ->where('check', '=', '0')->value('user_id');


        Appointment::query()->where('id', '=', $id)->delete();

        broadcast(new NotificationEvent("حذف مهمه", "  تم حذف مهمة مسندة لك مسبقاً   ", $user_id, $idtask));
        $realTime = Notification::create([
            'title' => "حذف مهمه",
            'receiver_id' => $user_id,
            'message' => "  تم حذف مهمة مسندة لك مسبقاً  ",
            'type' => 'حذف مهمة',
            'need_id' => $idtask

        ]);
        $realTime->save();


        return response()->json([
            'message' => "this appointment has deleted",
        ]);
    }

    public function Store_Task(Request $request)
    {

        $c = false;
        $valid = $request->validate([
            'child_id' => 'required ',
            'app_date' => 'required ',
        ]);
        $pp = Appointment::create([
            'child_id' => $valid['child_id'],
            'app_date' => $valid['app_date'],

        ]);
        $Appointment_id = $pp->id;

        $valid = $request->validate([
            'user_id' => 'required ',
            'app_id' => 'require',
            'hours' => 'required ',
            'start' => 'required ',
            'description' => 'required ',
            'title' => 'required ',
            'check' => 'required ',

        ]);




        $appdate = Appointment::where('id', '=', $Appointment_id)->value("app_date");
        $group = DB::table('appointments')
            ->join('tasks', 'appointments.id', '=', 'tasks.app_id')
            ->where('appointments.app_date', '=', $appdate)
            ->where('tasks.user_id', '=', $valid['user_id'])
            ->where('tasks.check', '=', '0')
            ->select('appointments.app_date', 'tasks.hours', 'tasks.start', 'tasks.user_id')->get();


        foreach ($group as $row) {

            $hours = $row->hours;
            $minutes = 0;
            $seconds = 0;


            $row_start = Carbon::createFromTimeString($row->start);
            $row_hours = Carbon::createFromTime($hours, $minutes, $seconds);
            $valid_start = Carbon::createFromTimeString($valid['start']);
            $valid_hours = Carbon::createFromTimeString($valid['hours']);
            $end = Carbon::createFromTimeString('20:00:00');
            $start = Carbon::createFromTimeString('8:00:00');

            $row_s = clone $row_start;
            $row_h = clone $row_hours;
            $row_s->addHours($row_h->hour);
            $row_s->addMinutes($row_h->minute);
            $row_s->addSeconds($row_h->second);
            $valid_s = clone $valid_start;
            $valid_h = clone $valid_hours;
            $valid_s->addHours($valid_h->hour);
            $valid_s->addMinutes($valid_h->minute);
            $valid_s->addSeconds($valid_h->second);

            if ($valid_s->greaterThanOrEqualTo($end) || $start->greaterThanOrEqualTo($valid_start)) {
                return response()->json([
                    'message' => 'This Time is out ',
                ]);
            }

            //                  echo $valid_s;
            //                  echo "+++++++++++++++++++++++++++++++++++\n";
            //                  echo $row_start;
            //                  echo "+++++++++++++++++++++++++++++++++++\n";
            //                  echo $valid_start;
            //                  echo "+++++++++++++++++++++++++++++++++++\n";
            //                  echo $row_s;
            //                  echo "+++++++++++++++++++++++++++++++++++\n";
            if ($valid_start->greaterThanOrEqualTo($row_s))
                $c = true;
            else{
                if ($row_start->greaterThanOrEqualTo($valid_s))
                    $c = true;
            }

            if ($c == true) {

                $tt = Task::create([
                    'user_id' => $valid['user_id'],
                    'app_id' => $Appointment_id,
                    'hours' => $valid['hours'],
                    'description' => $valid['description'],
                    'title' => $valid['title'],
                    'start' => $valid['start'],
                    'check' => $valid['check'],
                ]);
                $child_name = Child::where('id', Appointment::where('id', '=', $Appointment_id)->value('child_id'))->value("name");
                broadcast(new NotificationEvent("ارسال موعد",  "{$child_name} تم ارسال موعد الى طفلكم ", Appointment::where('id', '=', $Appointment_id)->value('child_id'), $Appointment_id));
                $realTime = ChildNotification::create([
                    'title' => "ارسال موعد",
                    'receiver_id' => Appointment::where('id', '=', $Appointment_id)->value('child_id'),
                    'message' => "{$child_name} تم ارسال موعد الى طفلكم ",
                    'type' => 'ارسال موعد',
                    'need_id' => $Appointment_id
                ]);

                $realTime->save();

                $task_id = $tt->id;
                $user_name = User::where('id', $valid['user_id'])->value("name");
                broadcast(new NotificationEvent("اسناد مهمه", " تم اسناد مهه لك  ", $valid['user_id'], $tt['id']));
                $realTime = Notification::create([
                    'title' => "اسناد مهمه",
                    'receiver_id' => $valid['user_id'],
                    'message' => " {$user_name} تم اسناد مهه لك  ",
                    'type' => 'اسناد مهمة',
                    'need_id' => $task_id

                ]);
                $realTime->save();



                return response()->json([
                    'message' => 'A Task has been booked successfully',
                    'Task' => $tt,
                ]);
            } else {

                Appointment::where('id', '=', $Appointment_id)->delete();
                return response()->json([
                    'message' => 'This user is busy in this time',
                ]);
            }
        }



        if ($group->isEmpty()) {
            $tt = Task::create([
                'user_id' => $valid['user_id'],
                'app_id' => $Appointment_id,
                'hours' => $valid['hours'],
                'description' => $valid['description'],
                'title' => $valid['title'],
                'start' => $valid['start'],
                'check' => $valid['check'],

            ]);


            $task_id = $tt->id;
            $user_name = User::where('id', $valid['user_id'])->value("name");

            broadcast(new NotificationEvent(" اسناد مهمه", " تم اسناد مهه لك  ", $valid['user_id'], $tt['id']));
            $realTime = Notification::create([
                'title' => "اسناد مهمه",
                'receiver_id' => $valid['user_id'],
                'message' => " {$user_name} تم اسناد مهه لك  ",
                'type' => 'اسناد مهمة',
                'need_id' => $task_id

            ]);
            $realTime->save();

            return response()->json([
                'message' => 'A Task has been booked successfully',
                'Task' => $tt,
            ]);
        }
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

            broadcast(new NotificationEvent("انهاء مهمه", $task_name . "  تم انهاء المهمه بنجاح ", 1.5, $task_id));
            $realTime = Notification::create([
                'title' => "انهاء مهمه",
                'receiver_id' => 1.5,
                'message' => $task_name . "  تم انهاء المهمه بنجاح ",
                'type' => 'انهاء مهمة',
                'need_id' => $task_id

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

        $task = Task::where('id', $task_id)->first();
        return $this->sendResponse(new TaskkResource($task), 'success');
    }
}
