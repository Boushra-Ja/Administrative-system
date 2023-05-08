<?php

namespace App\Http\Resources\Boshra;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'count' => $this->count ,
            'emp_id' => $this->id ,
            'name' => User::where('id' , $this->id)->value('name') ,
            'email' => User::where('id' , $this->id)->value('email'),
            'points' => User::where('id' , $this->id)->value('points')
        ] ;
    }
}
