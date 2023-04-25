<?php

namespace App\Http\Resources\Boshra;

use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalQuesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'ques_id' => $this->id ,
            'question' => $this->question ,
            'type' => $this->type ,
            'title_id' => $this->title_id ,
            'title' => Titels::where('id' , $this->title_id)->value('name') ,
            'title_type' => Titels::where('id' , $this->title_id)->value('type')

        ];
    }
}
