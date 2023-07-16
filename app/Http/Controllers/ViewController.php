<?php

namespace App\Http\Controllers;

use App\Http\Resources\Report;
use App\Http\Resources\ReportInfection;
use App\Models\Child;
use App\Models\Diseases;
use App\Models\Infection;
use Database\Seeders\InfectionSeeder;
use Illuminate\Http\Request;
use App\Models\View;
use App\Models\TestResault;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{


    function Store_row($g)
    {

        $currentYear = date('Y');
        $model = View::query()->
        where('diseases_id', '=', $g)->
        where('year', '=', $currentYear)
            ->value('number');
        if ($model !== null) {
            View::where('diseases_id', '=', $g)->
            where('year', '=', $currentYear)->update(['number' => $model + 1]);

        } else {
//
//
            $model2 = View::query()->
            where('diseases_id', '=', $g)->
            where('year', '=', $currentYear)->
            value('number');
            //dd($model2) ;
            if ($model2 !== null) {
                View::where('diseases_id', '=', $g)->where('year', '=', $currentYear)->update(['number' => $model + 1]);

            } else {

                Artisan::call('db:seed', [
                    '--class' => 'ViewSeeder'
                ]);

                $model2 = View::query()->
                where('diseases_id', '=', $g)->
                where('year', '=', $currentYear)->
                value('number');
                if ($model2 !== null) {
                    View::where('diseases_id', '=', $g)->where('year', '=', $currentYear)->update(['number' => $model + 1]);

                }
            }


        }
    }


    //احصائيات لجميع الامراض خلال سنه او اكثر
    public function All_Diseases($myArray)
    {
        $ids = DB::table('diseases')->pluck('id')->toArray();
        $ids = array_map('intval', $ids); // Convert the values to integers
        $myArray = explode(',', $myArray);

        $results = [];
        $results2 = [];

        foreach ($ids as $value) {
            $data = DB::table('views')
                ->whereIn('year', $myArray)
                ->where('diseases_id', '=', $value)
                ->get(['number', 'diseases_id', 'year']);

            $sum = $data->sum('number');

            $results[$value] = Report::collection($data);
            $name = DB::table('diseases')
                ->where('id', '=', $value)
                ->get()->value('name');
            $results2[$value] = [$sum, $name];

        }

        return response()->json(
            $results2
        );
    }


    //احصائيات لمرض معين (واحد فقط) خلال سنه او اكثر
    public function MatchingList($myArray, $id)
    {

        $myArray = explode(',', $myArray);
        $results = DB::table('views')
            ->whereIn('year', $myArray)
            ->where('diseases_id', '=', $id)
            ->get(['number', 'diseases_id', 'year']);
        // echo $results;
        // $sum = $results->sum('number');

        //   return response()->json($results
        // Report::collection($results)
        // );

        return response()->json([
            'results' => Report::collection($results),
            //'sum' => $sum
        ]);
    }


    public function store_infection($child_id, $dim_id)
    {

        $res = TestResault::where('child_id', $child_id)->where('dim_id', $dim_id)->latest('created_at')->first();
        if ($res) {

            $state = "";
            $age = Child::where('id', $child_id)->value('age');
            $data = ((($res->basal * 12) + $res->additional) / $age) * 100;


            if ($data <= 25)
                $state = "شديد جداً";
            else if ($data > 25 && $data <= 40)
                $state = "شديد";
            else if ($data > 40 && $data <= 55)
                $state = "متوسط";
            else if ($data > 55 && $data <= 70)
                $state = "بسيط";
            else if ($data > 70 && $data <= 85)
                $state = "بسيط جداً";
            else
                $state = "طبيعي";


            $currentYear = date('Y');
            $model = Infection::query()->
            where('name', '=', $state)
                ->where('year', '=', $currentYear)
                ->value('number');

            if ($model !== null) {
                echo $model;
                Infection:: where('name', '=', $state)->
                where('year', '=', $currentYear)->update(['number' => $model + 1]);

            } else {

                $model2 = Infection::query()->
                where('name', '=', $state)->
                where('year', '=', $currentYear)->
                value('number');
                //dd($model2) ;
                if ($model2 !== null) {
                    Infection::where('name', '=', $state)->where('year', '=', $currentYear)->update(['number' => $model + 1]);

                } else {

                    Artisan::call('db:seed', [
                        '--class' => 'InfectionSeeder'
                    ]);

                    $model2 = Infection::query()->
                    where('name', '=', $state)->
                    where('year', '=', $currentYear)->
                    value('number');
                    if ($model2 !== null) {
                        Infection::where('name', '=', $state)->where('year', '=', $currentYear)->update(['number' => $model + 1]);

                    }
                }

            }


        }


    }

    public function All_Infections($myArray)
    {
        $myArray = explode(',', $myArray);
        $results22 = ['شديد جداً','شديد','متوسط','بسيط','بسيط جداً','طبيعي'];
        $data=[];
        foreach ($results22 as $value) {

                $data[$value] = DB::table('infections')
                ->whereIn('year', $myArray)
                ->where('name', '=', $value)
                ->get(['number', 'name' ]);

                $sum =  $data[$value]->sum('number');
                $data[$value] = $sum;
        }

        return response()->json(
            $data
        );
    }


}

























































/*
 INSERT INTO `children` (`id`, `name`, `age`, `phone_num`, `infection`, `section`, `created_at`, `updated_at`, `deleted_at`, `unique_number`) VALUES ('1', 'qqq', '111', '3333', 'qqq', 'qqq', NULL, NULL, NULL, '11');
  */


/*{
    "child_id": 1,
    "ans": [
        {
            "ques_id": 32,
            "answer": "داون"
        },
        {
            "ques_id": 32,
            "answer": "توريت"
        }
    ]
}*/
