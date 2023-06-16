<?php

namespace App\Http\Resources\bayan;

use App\Models\EductionalChoice;
use App\Models\EductionalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Education_QResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $question = EductionalQuestion::where('titel_id', '=', $this->id)->get();
        $d= E_choiceResource::collection($question);


        return [
            'title' => $this->name,
            'list' => $d,

        ];

    }
}
