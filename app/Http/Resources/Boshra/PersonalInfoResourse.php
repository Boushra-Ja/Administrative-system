<?php

namespace App\Http\Resources\Boshra;

use App\Models\Child;
use App\Models\PersonalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalInfoResourse extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'ques_id' => $this->ques_id ,
            'answer' => $this->answer ,
            'question' => PersonalQuestion::where('id' , $this->ques_id)->value('question'),
            'type' => PersonalQuestion::where('id' , $this->ques_id)->value('type'),
            'title' => Titels::where('id' , PersonalQuestion::where('id' , $this->ques_id)->value('title_id'))->value('name')
        ];
    }
}
