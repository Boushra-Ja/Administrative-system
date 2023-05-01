<?php

namespace App\Http\Resources\bayan;

use App\Models\MedicalChoice;
use App\Models\MedicalQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Medical_QResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $choice = null;
        $question = MedicalQuestion::where('titel_id', '=', $this->id)->get();
        foreach($question as $item){
            if($item->id == '2')
            $choice=MedicalChoice::where('med_id','=',$item->id)->get();
        }


        return [
            'title' => $this->name ,
            'question' => $question ,
            'choice'=>$choice
        ];
    }
}
