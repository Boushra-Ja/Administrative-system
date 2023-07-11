<?php

namespace App\Http\Resources\bayan;

use App\Http\Controllers\CenterController;
use App\Models\EductionalChoice;
use App\Models\EductionalCondition;
use App\Models\EductionalQuestion;
use App\Models\Titels;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Education_AResource extends JsonResource
{

    public function toArray(Request $request): array
    {


        $question = EductionalQuestion::where('titel_id', '=', $this->id)->get();

        if($this->id == 14){
            $d = CenterController::show( $request->id);

        }

        else
           $d= E_A_Q_Resource::collection($question);



        return [
            'title' => $this->name ,
            'question' => $d ,

        ];

    }
}
