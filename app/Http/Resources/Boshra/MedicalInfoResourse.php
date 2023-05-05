<?php

namespace App\Http\Resources\Boshra;

use App\Models\MedicalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalInfoResourse extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'ques_id' => $this->ques_id ,
            'answer' => $this->answer ,
            'question' => MedicalQuestion::where('id' , $this->ques_id)->value('question'),
            'type' => MedicalQuestion::where('id' , $this->ques_id)->value('type'),
            'title' => Titels::where('id' , MedicalQuestion::where('id' , $this->ques_id)->value('titel_id'))->value('name')
        ];
    }
}
