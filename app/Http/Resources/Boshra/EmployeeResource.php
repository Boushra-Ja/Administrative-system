<?php

namespace App\Http\Resources\Boshra;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'count' => Task::where('user_id'  , $this->id)->where('tasks.check' , 0)->count() ,
            'emp_id' => $this->id ,
            'name' => $this->name ,
            'email' => $this->email,
            'points' => $this->points,
            'unique_number' => $this->unique_number
        ] ;
    }
}
