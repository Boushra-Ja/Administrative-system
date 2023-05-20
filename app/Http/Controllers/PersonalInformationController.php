<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\PersonalInformation;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Http\Resources\Boshra\PersonalInfoResourse;
use App\Models\Child;
use App\Models\MemberFamily;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\isEmpty;

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

        $answers = null;
        $family = null;


        if ($request->has('child_info')) {

            $personal_info = $request->child_info;
            foreach ($personal_info as $item) {

                $answers = PersonalInformation::create(
                    [
                        'answer' => $item['answer'],
                        'ques_id' => $item['ques_id'],
                        'child_id' =>  $child_id
                    ]
                );

                if ($answers == null) {
                    return $this->sendErrors([], 'failed in added child');
                }
            }

            if ($request->has('sister_info')) {
                $my_family  = $request->sister_info;
                $family = MemberFamilyController::store($my_family, $child_id);
            }
            return $this->sendResponse($family, 'success in add all information ');
        }
        return $this->sendErrors([], 'failed in added child');
    }



    public function update_child(UpdatePersonalInformationRequest $request)
    {

        $personal_info = $request->child_info;
        $my_family  = $request->sister_info;
        $age = Child::where('id', $request->child_id)->value('age');

        foreach ($personal_info as $item) {
            $found = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id', $item['ques_id'])->get();

            if (!($found->isEmpty())) {
                $child = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id', $item['ques_id']);

                if ($item['answer'] == '') {
                    $child->delete();
                } else {
                    $child->update([
                        'answer' => $item['answer'],
                    ]);
                }
            }
            else{
                PersonalInformation::create(
                    [
                        'answer' => $item['answer'],
                        'ques_id' => $item['ques_id'],
                        'child_id' =>  $request->child_id
                    ]
                );
            }
            if ($item['ques_id'] == 4) {
                $years = (int)Carbon::parse($item['answer'])->diff(Carbon::now())->format('%y');
                $months = (int)Carbon::parse($item['answer'])->diff(Carbon::now())->format('%m');

                $age = ($years * 12) + $months;
            }
        }
        $c = Child::where('id', $request->child_id);
        if ($c) {
            $c->update([
                'phone_num' => $request->phone_number,
                'name' => $request->name,
                'age' => $age
            ]);
        }

        $my_sister = MemberFamily::where('child_id', '=', $request->child_id);
        $my_sister->delete() ;

        foreach ($my_family as $indivual) {
            $family = MemberFamily::where('id', '=', $indivual['id']);

            if ($family) {
                $family->create(
                    [
                        'child_id' => $request->child_id,
                        'age' => $indivual['age'],
                        'name' => $indivual['name'],
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
    }
}
