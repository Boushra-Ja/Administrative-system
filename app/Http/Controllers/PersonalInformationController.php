<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\PersonalInformation;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Http\Resources\Boshra\PersonalInfoResourse;
use App\Models\Child;
use Illuminate\Support\Facades\DB;

class PersonalInformationController extends BaseController
{

    public function index()
    {

    }
    public function show($child_id)
    {

    }


    public function store(StorePersonalInformationRequest $request)
    {
        $child_id = Child::orderBy('created_at', 'desc')->first()->value('id') ;
        $child = PersonalInformation::create([
            'answer' => $request->answer,
            'ques_id' => $request->ques_id,
            'child_id' =>  $child_id

        ]);

        if($child)
            return $this->sendResponse($child, 'success in add all information ');

        return $this->sendErrors([], 'failed in added child');
    }



    public function update(UpdatePersonalInformationRequest $request)
    {
        $child = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id' , $request->ques_id)->get();
        $child->update([
            'answer' => $request->answer,
        ]);

        if($child)
            return $this->sendResponse($child, 'success in update information of child');

        return $this->sendErrors([], 'failed in update information of child');
    }


    public function destroy(PersonalInformation $personalInformation)
    {
        //
    }
}
