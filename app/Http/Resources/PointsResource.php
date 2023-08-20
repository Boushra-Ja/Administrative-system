<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PointsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[


            'Count' => Task::where('user_id' , $this->id)->get()->count(),
            'points' => $this->points,
            'name' => $this->name,
            'scientific_level' => $this->scientific_level,
            'id' => $this->id,
        ];
    }
}
