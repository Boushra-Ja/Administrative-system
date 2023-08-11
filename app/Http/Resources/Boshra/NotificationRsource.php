<?php

namespace App\Http\Resources\Boshra;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationRsource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'user_name' => User::where('id' , $this->user_id)->value('name') ,
            'terminate_date' => $this->updated_at

        ];
    }
}
