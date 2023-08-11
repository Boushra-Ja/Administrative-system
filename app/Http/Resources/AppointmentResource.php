<?php

namespace App\Http\Resources;

use App\Models\Child;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class appointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            'app_date' => $this->app_date ,
            'user_name'=>User::where ('id',Task::where('app_id',$this->id)->value('user_id'))->value('name'),
            'child_name'=>  Child::where('id' , $this->child_id)->value('name'),
            'infection'=>  Child::where('id' , $this->child_id)->value('infection'),
            'section'=>  Child::where('id' , $this->child_id)->value('section'),
            'number'=>  Child::where('id' , $this->child_id)->value('phone_num'),
            'age'=>  Child::where('id' , $this->child_id)->value('age'),
            'check'=>Task::where('app_id',$this->id)->value('check'),
            'hours' => Task::where('app_id',$this->id)->value('hours'),
            'start' => Task::where('app_id',$this->id)->value('start'),


        ];
    }
}
