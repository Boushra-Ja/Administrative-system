<?php

namespace App\Http\Resources\Boshra;

use App\Http\Controllers\TestResaultController;
use App\Models\PortageDimenssion;
use App\Models\TestResault;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use NunoMaduro\Collision\Adapters\Phpunit\TestResult;

class TableResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'social' => TestResaultController ::table($this->id , 2) ,
            'monotor' => TestResaultController ::table($this->id , 1) ,
            'care' => TestResaultController ::table($this->id , 3) ,
            'comm' => TestResaultController ::table($this->id , 4) ,
            'know' => TestResaultController ::table($this->id , 5) ,

        ];
    }
}
