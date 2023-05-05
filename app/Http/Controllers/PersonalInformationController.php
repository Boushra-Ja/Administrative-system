<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\PersonalInformation;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Http\Resources\Boshra\PersonalInfoResourse;
use App\Models\Child;
use App\Models\MemberFamily;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

use function PHPSTORM_META\type;

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
        $child_id = Child::orderBy('created_at', 'desc')->first()['id'];

        $personal_info = $request->child_info;
        $my_family  = $request->sister_info;


        foreach ($personal_info as $item) {

            $answers = PersonalInformation::create([
                'answer' => $item['answer'],
                'ques_id' => $item['ques_id'],
                'child_id' =>  $child_id
                ]
            );
        }

        $family = MemberFamilyController::store($my_family , $child_id) ;

        if ($answers && $family )
            return $this->sendResponse($my_family, 'success in add all information ');

        return $this->sendErrors([], 'failed in added child');
    }



    public function update_child(UpdatePersonalInformationRequest $request )
    {

        $personal_info = $request->child_info;
        $my_family  = $request->sister_info;

        foreach ($personal_info as $item) {
            $child = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id', $item['ques_id']);
          //  dd($child) ;
          if($child)
           {
            $child->update([
                'answer' => $item['answer'],
            ]);

           }
        }

        foreach ($my_family as $indivual) {
            $family = MemberFamily::where('id', '=', $indivual['id']);

            if($family)
            {
                $family->update(
                    [
                        'child_id' => $request->child_id,
                        'age' => $indivual['age'],
                        'name' => $indivual['name'] ,
                        'gender' => $indivual['gender'],
                        'Educ_level' => $indivual['Educ_level']
                    ]
                );
            }

        }

        if ($child && $family)
            return $this->sendResponse($family, 'success in update information of child');

        return $this->sendErrors([], 'failed in update information of child');
    }


    public function destroy(PersonalInformation $personalInformation)
    {
        //
    }
}
