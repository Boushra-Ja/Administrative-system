<?php

namespace App\Http\Resources;

use App\Models\Diseases;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Report extends JsonResource
{

    public function toArray(Request $request): array
    {    $e=0;
           $e= $e+$this->number;

        return [
            'number'=> $e,
                //$this->number,
            'name'=> Diseases::where('id' , $this->diseases_id)->value('name'),
             'year'=>$this->year,


        ];
    }
}
