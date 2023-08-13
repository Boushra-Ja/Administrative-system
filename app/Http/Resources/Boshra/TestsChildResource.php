<?php

namespace App\Http\Resources\Boshra;

use App\Http\Controllers\TestResaultController;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestsChildResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $ratio = TestResaultController::graph_test($this->child_id) ;

        return [
            'section' =>Child::where('id' , $this->child_id)->value('section') ,
            'infection' => Child::where('id' , $this->child_id)->value('infection') ,
            'test_date' => $this->created_at->format('Y-m-d ') ,
            'new_social_ratio' => $ratio[0],
            'old_social_ratio' => $ratio[1],
            'new_montor_ratio' => $ratio[2],
            'old_montor_ratio' => $ratio[3],
            'new_care_ratio' => $ratio[4],
            'old_care_ratio' => $ratio[5],
            'new_comm_ratio' => $ratio[6],
            'old_comm_ratio' => $ratio[7],
            'new_know_ratio' => $ratio[8],
            'old_know_ratio' => $ratio[9],
            'social' => TestResaultController ::table($this->child_id , 2) ,
            'monotor' => TestResaultController ::table($this->child_id , 1) ,
            'care' => TestResaultController ::table($this->child_id , 3) ,
            'comm' => TestResaultController ::table($this->child_id , 4) ,
            'know' => TestResaultController ::table($this->child_id , 5) ,

        ];
    }


}
