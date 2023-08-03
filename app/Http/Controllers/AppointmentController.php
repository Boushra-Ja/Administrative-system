<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Http\Middleware\AppMiddleware;

use App\Http\Resources\appointmentResource;
use App\Http\Resources\PhoneResource;
use App\Models\Appointment;
use App\Models\Child;
use App\Models\Notification;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware(AppMiddleware::class);
    }

    public function home(){

        dd('You are active');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store_Appointment(Request $request)
    {


        $valid = $request->validate([
            'child_id' => 'required ',
            'app_date' => 'required ',



        ]);

        $pp = Appointment::create([
            'child_id' => $valid['child_id'],
            'app_date' => $valid['app_date'],

        ]);

        $Appointment_id = Appointment::where('child_id' , $valid['child_id'])->value("id");
        $child_name = Child::where('id' , $valid['child_id'])->value("name");

        broadcast(new NotificationEvent("ارسال موعد",  "{$child_name} تم ارسال موعد الى طفلكم ",$valid['child_id'],$Appointment_id));
        $realTime = Notification::create([
            'title' => "ارسال موعد",
            'receiver_id' =>$valid['child_id'],
            'message' => "{$child_name} تم ارسال موعد الى طفلكم ",

        ]);
//
        $realTime->save();
        return response()->json([
            'message'=>'An Appointment has been booked successfully',
            'Appointment' => $pp,
        ]);

    }

    public function details_ِApp($app_id )
    {


        $date_app=Appointment::where('id' ,$app_id )->value('app_date');
        $child_name=Child::where ( 'id',Appointment::where('id' , $app_id)->value('child_id'))->value('name');


        $one= "تم ارسال موعد لطفلكم ";
        $tow=" وذلك بتاريخ ";
        $three=" يرجى التقيد بالموعد والالتزام ";
        $four=" شاكرين تعاونكم";


        return response()->json([
            'message'=>$one.$child_name.$tow.$date_app.$three.$four,
        ]);


    }



    public function Show_appointment(Request $request)
    {


        $AppModel = Appointment::query()->get();
        return response()->json([
            'Appointment' => AppointmentResource::collection($AppModel),
        ]);


    }


    public function Show_Phones(Request $request)
    {


        $child = Child::query()->get();
        return response()->json([
            'phones' => PhoneResource::collection($child),
        ]);


    }



}
