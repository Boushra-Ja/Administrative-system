<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Child;
use App\Models\PersonalInformation;
use App\Models\PortageDimenssion;
use App\Models\TestResault;
use Illuminate\Http\Request;

class TestResaultController extends BaseController
{

    public function store_res(Request $request)
    {
        $f_name = $request->father_name ;
        $child_name = $request->child_name ;
        $child_id = Child::where('name' , $child_name )->get()->value('id') ;

        $res = TestResault::create([
            'child_id' => $request->name,
            'basal' => $request->basal,
            'additional' => $request->additional,
            'dim_id' => $request->dim_id
        ]);

        if($res)
        {
            return $this->sendResponse($res , 'success in store resault') ;

        }
        return $this->sendError([] , 'error in store the resault') ;
    }

    public function store_test(Request $request)
    {
        foreach ($request->ans as $item) {

            $answers = TestResault::create(
                [
                    'child_id' => $request->child_id,
                    'basal' => $item['basal'],
                    'additional' => $item['additional'],
                    'dim_id' => $item['dim_id']
                ]
            );


            (new  ViewController)->store_infection($request->child_id, $answers['dim_id']);
        }

        if ($answers)
            return response()->json($answers, 200);

        return response()->json([], 201);
    }



    public static function  graph_test($child_id)
    {

        $ratio = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $age = Child::where('id', $child_id)->value('age');

        $s_dim = TestResault::where('child_id', $child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاجتماعي')->value('id'))
            ->orderBy('created_at', 'Desc')->take(2)->get();

        $i = 0;
        foreach ($s_dim as $elem) {
            $ratio[$i] = (($elem['basal'] + $elem['additional']) / $age) * 100;
            $i++;
        }
        if ($i != 2) {
            $i = 2;
        }

        $m_dim = TestResault::where('child_id', $child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الحركي')->value('id'))
            ->orderBy('created_at', 'Desc')->take(2)->get();

        foreach ($m_dim as $elem) {
            $ratio[$i] = (($elem['basal'] + $elem['additional']) / $age) * 100;
            $i++;
        }

        if ($i != 4) {
            $i = 4;
        }

        $c_dim = TestResault::where('child_id', $child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'بعد العناية الذاتية')->value('id'))
            ->orderBy('created_at', 'Desc')->take(2)->get();

        foreach ($c_dim as $elem) {
            $ratio[$i] = (($elem['basal'] + $elem['additional']) / $age) * 100;
            $i++;
        }
        if ($i != 6) {
            $i = 6;
        }

        $com_dim = TestResault::where('child_id', $child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاتصالي')->value('id'))
            ->orderBy('created_at', 'Desc')->take(2)->get();

        foreach ($com_dim as $elem) {
            $ratio[$i] = (($elem['basal'] + $elem['additional']) / $age) * 100;
            $i++;
        }

        if ($i != 8) {
            $i = 8;
        }


        $k_dim = TestResault::where('child_id', $child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد المعرفي')->value('id'))
            ->orderBy('created_at', 'Desc')->take(2)->get();

        foreach ($k_dim as $elem) {
            $ratio[$i] = (($elem['basal'] + $elem['additional']) / $age) * 100;
            $i++;
        }

        return $ratio;
    }

    static function  table($child_id, $dim_id)
    {
        $res = TestResault::where('child_id', $child_id)->where('dim_id', $dim_id)->latest('created_at')->first();
        if ($res) {
            $state = "";
            $age = Child::where('id', $child_id)->value('age');
            $data = ((($res->basal * 12) + $res->additional) / $age) * 100;
            if ($data <= 25)
                $state = "شديد جداً";
            else if ($data > 25 && $data <= 40)
                $state = "شديد ";
            else if ($data > 40 && $data <= 55)
                $state = "متوسط ";
            else if ($data > 55 && $data <= 70)
                $state = "بسيط ";
            else if ($data > 70 && $data <= 85)
                $state = "بسيط جداً";
            else
                $state = " طبيعي";
            $total = ($res->basal * 12) + $res->additional;
            $month = $total % 12;
            $year = ($total - $month) / 12;
            return   [
                'dimantion' => PortageDimenssion::where('id', $dim_id)->value('title'),
                'performance' => $state,
                'performance_ratio' => number_format($data, 2),
                'year' => $year,
                'month' => $month,
            ];
        }
        else{

            return   [
                'dimantion' => PortageDimenssion::where('id', $dim_id)->value('title'),
                'performance' => 0,
                'performance_ratio' => 0.0,
                'year' => 0,
                'month' => 0,
            ];
        }
    }


    static public function connect_between_sys3(Request $request)  {

        $childs = Child::where('name' , $request->child_name)->get() ;
        foreach ($childs as $child ) {
            $f_name = PersonalInformation::where('child_id',$child['id'])
            ->where('ques_id' , 19)->value('answer') ;

            if($f_name == $request->father_name)
            {
                $child_id = $child['id'] ;
            }
        }

        $dim_id = PortageDimenssion::where('title' , $request->diminssion)->value('id') ;

        $answers = TestResault::create(
            [
                'child_id' => $child_id,
                'basal' => $request->basal,
                'additional' => $request->additional,
                'dim_id' => $dim_id
            ]
        );

        (new  ViewController)->store_infection($child_id, $dim_id);

        return $answers;
    }


}
