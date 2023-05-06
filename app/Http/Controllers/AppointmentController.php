<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AppMiddleware;
use App\Models\Appointment;
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


    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
