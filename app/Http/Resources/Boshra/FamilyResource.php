<?php

namespace App\Http\Resources\Boshra;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'age' => $this->age ,
            'gender' => $this->gender ,
            'Educ_level' => $this->Educ_level
        ];
    }
}
