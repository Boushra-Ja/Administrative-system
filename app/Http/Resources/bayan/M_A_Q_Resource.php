<?php

namespace App\Http\Resources\bayan;

use App\Models\EductionalChoice;
use App\Models\EductionalCondition;
use App\Models\EductionalQuestion;
use App\Models\MedicalChoice;
use App\Models\MedicalCondition;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class M_A_Q_Resource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $choice=null;

        if($this->id == '4'||$this->id == '9'||$this->id == '2'||$this->id == '10'||$this->id == '17'||$this->id == '20' )
        $choice=MedicalChoice::where('med_id','=',$this->id)->get(['choice']);

        $ans=MedicalCondition::where('ques_id',$this->id)->where('child_id',$request->id)->first();

        return [
            'question' => $this->question,
            'answer'=>$ans->answer,
            'choice'=>$choice

        ];
    }
}
