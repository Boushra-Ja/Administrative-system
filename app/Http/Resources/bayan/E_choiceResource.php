<?php

namespace App\Http\Resources\bayan;

use App\Models\EductionalChoice;
use App\Models\EductionalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class E_choiceResource extends JsonResource
{

    public function toArray(Request $request): array
    {


        $choice=null;

             if($this->id == '4'||$this->id == '1'||$this->id == '2'||$this->id == '3'||$this->id == '5'||$this->id == '6' )
                $choice=EductionalChoice::where('edu_id',$this->id)->get(['choice']);
        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'titel_id'=>$this->titel_id,
            'type'=>$this->type,
            'choice' => $choice,

        ];
    }
}
