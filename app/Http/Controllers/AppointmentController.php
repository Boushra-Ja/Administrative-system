<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AppMiddleware;

use App\Http\Resources\appointmentResource;
use App\Http\Resources\PhoneResource;
use App\Models\Appointment;
use App\Models\Child;
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
        return response()->json([
            'message'=>'An Appointment has been booked successfully',
            'Appointment' => $pp,
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


    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
