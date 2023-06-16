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

        $question = MedicalQuestion::where('titel_id', '=', $this->id)->get();
        $d= M_choiceResource::collection($question);


        return [
            'title' => $this->name ,
            'list' => $d,
        ];
    }
}
