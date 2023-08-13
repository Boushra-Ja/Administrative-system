<?php

namespace App\Http\Resources\Boshra;

use App\Models\Appointment;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'hours' => $this->hours ,
            'description' => $this->description ,
            'check' => $this->check ,
            'title' => $this->title ,
            'app_id' => $this->app_id ,
            'notes' => $this->notes ,
            'child_name' => Child::where('id' , Appointment::where('id' , $this->app_id)->value('child_id'))->value('name'),
            'created_at' => $this->created_at->format('Y-m-d '),
            'start' =>$this->start
        ];
    }
}
