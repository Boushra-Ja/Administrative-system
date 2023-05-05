<?php

namespace App\Http\Resources\Boshra;

use App\Models\EductionalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationInfoResourse extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'ques_id' => $this->ques_id ,
            'answer' => $this->answer ,
            'question' => EductionalQuestion::where('id' , $this->ques_id)->value('question'),
            'type' => EductionalQuestion::where('id' , $this->ques_id)->value('type'),
            'title' => Titels::where('id' , EductionalQuestion::where('id' , $this->ques_id)->value('titel_id'))->value('name')
        ];
    }
}
