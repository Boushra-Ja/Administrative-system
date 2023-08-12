<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use App\Models\Bouns;
use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date_task'=>Appointment::where('id' , $this->app_id)->value('app_date'),
            'title'=> $this->title,
            'description'=>$this->description,
            'check'=>$this->check,
            'user_name'=>User::where('id' , $this->user_id)->value('name'),
            'hours'=>$this->hours,
            'child_name'=>Child::where ( 'id',Appointment::where('id' , $this->app_id)->value('child_id'))->value('name'),
            'child_section'=>Child::where ( 'id',Appointment::where('id' , $this->app_id)->value('child_id'))->value('section'),
            'start' => $this->start,
            'notes' => $this->notes,
            'child_section' => Child::where ( 'id',Appointment::where('id' , $this->app_id)->value('child_id'))->value('section'),
            'points'=>Bouns::where('task_id' , $this->id)->value('points'),
            'created_at' => $this->created_at->format('Y-m-d ')

        ];
    }
}
