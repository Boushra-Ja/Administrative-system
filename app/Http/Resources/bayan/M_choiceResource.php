<?php

namespace App\Http\Resources\bayan;

use App\Models\EductionalChoice;
use App\Models\EductionalQuestion;
use App\Models\MedicalChoice;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class M_choiceResource extends JsonResource
{

    public function toArray(Request $request): array
    {


        $choice=null;

             if($this->id == '4'||$this->id == '9'||$this->id == '2'||$this->id == '10'||$this->id == '17'||$this->id == '20' )
                $choice=MedicalChoice::where('med_id',$this->id)->get(['choice']);

        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'titel_id'=>$this->titel_id,
            'type'=>$this->type,

            'choice' => $choice,

        ];
    }
}
