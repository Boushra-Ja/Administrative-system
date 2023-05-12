<?php

namespace App\Http\Resources;

use App\Models\Child;
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

            'app_date' => $this->app_date ,
            'name'=>  Child::where('id' , $this->child_id)->value('name'),
            'infection'=>  Child::where('id' , $this->child_id)->value('infection'),
            'section'=>  Child::where('id' , $this->child_id)->value('section'),
            'number'=>  Child::where('id' , $this->child_id)->value('phone_num'),
            'age'=>  Child::where('id' , $this->child_id)->value('age'),
            ];
    }
}
