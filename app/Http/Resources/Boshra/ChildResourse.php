<?php

namespace App\Http\Resources\Boshra;

use App\Models\EductionalCondition;
use App\Models\MedicalCondition;
use App\Models\MemberFamily;
use App\Models\PersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResourse extends JsonResource
{

    public function toArray(Request $request): array
    {
        $personal_answers = PersonalInformation::where('child_id'  ,$this->id)->get() ;
        $family = MemberFamily::where('child_id' , $this->id)->get() ;
        $medical_answers = MedicalCondition::where('child_id'  ,$this->id)->get() ;
        $eductional_answers = EductionalCondition::where('child_id'  ,$this->id)->get() ;

        return [
            'child_id' => $this->id ,
            'name' => $this->name ,
            'age' =>$this->age ,
            'phone' => $this->phone_num ,
            'family' => FamilyResource::collection($family) ,
            'personal_info' => PersonalInfoResourse::collection($personal_answers),
            'medical_info' => MedicalInfoResourse::collection($medical_answers) ,
            'eductional_info' => EducationInfoResourse::collection($eductional_answers),
            //////later
            'appoinment' => []
        ];
    }
}
