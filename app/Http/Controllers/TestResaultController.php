<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\TestResault;
use App\Http\Requests\StoreTestResaultRequest;
use App\Http\Requests\UpdateTestResaultRequest;
use App\Http\Resources\Boshra\TableResource;
use App\Models\Child;
use App\Models\PortageDimenssion;
use Illuminate\Http\Request;

class TestResaultController extends BaseController
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public static function  graph_test($child_id) {

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

        return $ratio ;
    }

    static function  table($child_id , $dim_id) {
        $res=TestResault::where('child_id',$child_id)->where('dim_id',$dim_id)->latest('created_at')->first();
        if($res){

            $state="";

            $age=Child::where('id',$child_id)->value('age');
            $data=((($res->basal*12)+$res->additional)/$age)*100;

            if($data <= 25)
              $state="شديد جداً";
            else if($data > 25 && $data<= 40)
              $state="شديد ";
            else if($data > 40 && $data<= 55)
              $state="متوسط ";
            else if($data > 55 && $data<= 70)
              $state="بسيط ";
            else if($data > 70 && $data<= 85)
              $state="بسيط جداً";
            else
              $state=" طبيعي";



            $total=($res->basal*12)+$res->additional;
            $month=$total%12;
            $year=($total-$month)/12;

            return   [
                'dimantion' => PortageDimenssion::where('id', $dim_id)->value('title'),
                'performance' => $state,
                'performance_ratio' => $data,
                'year' => $year,
                'month' => $month,

            ];
        }
    }


}
