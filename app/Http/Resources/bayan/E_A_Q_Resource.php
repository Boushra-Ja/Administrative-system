<?php

namespace App\Http\Resources\bayan;

use App\Models\EductionalChoice;
use App\Models\EductionalCondition;
use App\Models\EductionalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class E_A_Q_Resource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $choice=null;

            if($this->id == '2')
            $choice=EductionalChoice::where('edu_id','=',$this->id)->get(['choice']);

        $ans=EductionalCondition::where('ques_id',$this->id)->where('child_id',$request->id)->first();

        return [
            'question' => $this->question,
            'answer'=>$ans->answer,
            'choice'=>$choice

        ];



    }
}
