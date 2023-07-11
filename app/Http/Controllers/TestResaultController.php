<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\TestResault;
use App\Http\Requests\StoreTestResaultRequest;
use App\Http\Requests\UpdateTestResaultRequest;
use App\Http\Resources\Boshra\TableResource;
use App\Models\Child;
use App\Models\PortageDimenssion;

class TestResaultController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestResaultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TestResault $testResault)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestResault $testResault)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestResaultRequest $request, TestResault $testResault)
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

    public function table_test($child_id) {

        $child = Child::where('id' , $child_id)->get() ;
        return $this->sendResponse(TableResource::collection($child) , 'success') ;


    }
}
