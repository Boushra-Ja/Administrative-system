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

        $choice = null;
        $question = EductionalQuestion::where('titel_id', '=', $this->id)->get();
        foreach($question as $item){
            if($item->id == '2')
            $choice=EductionalChoice::where('edu_id','=',$item->id)->get();
        }

        return [
            'title' => $this->name ,
            'question' => $question ,
            'choice'=>$choice

        ];
    }
}
