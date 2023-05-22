<?php

namespace App\Http\Resources\Boshra;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdviceResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id ,
            'text' => $this->text ,
            'child_id' => $this->child_id ,
            'child_name' => Child::where('id'  ,$this->child_id )->value('name'),
            'created_at' => $this->created_at

        ];
    }
}
