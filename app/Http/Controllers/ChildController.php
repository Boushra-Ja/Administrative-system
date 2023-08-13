<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Resources\Boshra\ChildResourse;
use App\Http\Resources\Boshra\ReportResource;
use App\Http\Resources\Boshra\TestsChildResource;
use App\Models\PortageDimenssion;
use App\Models\TestResault;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildController extends BaseController
{

    public function index_by_age()
    {
        $child = Child::orderBy('age', 'Asc')->get()->toArray();
        return response()->json($child, 200);
    }

    public function index_by_section($section)
    {
        $child = Child::where('section', '=', $section)->get();
        return response()->json($child, 200);
    }

    public function index_by_infection($infection)
    {
        $child = Child::where('infection', '=', $infection)->get();
        return response()->json($child, 200);
    }


    public function index()
    {
        $child = Child::all();
        return response()->json(ChildResourse::collection($child), 200);
    }

    public function child_names()
    {
        $childs = Child::all(['id', 'name']);

        if ($childs) {
            return $this->sendResponse($childs, 'this is all children');
        }
        return $this->sendErrors([], 'error in fetch all children');
    }

    static public function calculateAge($dateOfBirth)  {
        $d_now = (Carbon::now())->format('d');
        $m_now = (Carbon::now())->format('m');
        $y_now = (Carbon::now())->format('y');

        $d_child = Carbon::createFromFormat('d/m/Y', $dateOfBirth)->format('d');
        $m_child = Carbon::createFromFormat('d/m/Y', $dateOfBirth)->format('m');
        $y_child = Carbon::createFromFormat('d/m/Y', $dateOfBirth)->format('y');


        if ($d_now < $d_child) {
            $d_now += 30;
            $m_now -= 1;
        }
        if ($m_now < $m_child) {
            $m_now += 12;
            $y_now -= 1;
        }

        $d_diff = $d_now - $d_child;
        $m_diff = $m_now - $m_child;
        $y_diff = $y_now - $y_child;
        if ($d_diff >= 15) {
            $m_diff += 1;
        }

        $age = ($y_diff * 12) + $m_diff;

        return  $age;
    }


    static public function store( $age , $phone_number , $name)
    {
        $dateOfBirth = $age;

        $unique_num = random_int(100, 999999);
        $check  = Child::where('unique_number', $unique_num)->first();
        while ($check) {
            $unique_num = random_int(100, 999999);
            $check  = Child::where('unique_number', $unique_num)->first();
        }

        $age = ChildController::calculateAge($dateOfBirth);

        $child = Child::create([
            'name' => $name,
            'phone_num' => $phone_number,
            'age' => $age,
            'unique_number' => $unique_num

        ]);


        if ($child) {
            return  true ;
        }
        return false;
    }


    public function show($id)
    {

        $child = Child::where('id', $id)->get();
        return $this->sendResponse(ChildResourse::collection($child), "this is all information for child");
    }



    public function destroy($id)
    {
        $child = Child::where('id', '=', $id)->delete();
        if ($child) {
            $this->sendResponse($child, 'the child is deleted ');
        }
        $this->sendErrors([], 'failed in the delete child');
    }
    public function loginParent(Request $request)
    {

        $child = Child::where('unique_number', $request->unique_number)->first();
        if ($child) {
            return $this->sendResponse([$child], 'login success');
        }
        return $this->sendErrors([], 'the user is not registered...');
    }

    public function Report($child_id, Request $request)
    {

        $child = Child::where('id', $child_id)->get();
        $res = ReportResource::collection($child)->additional([
            'recomm' => $request->recomm,
            'summary' => $request->summary,
            'evaluation_tools' => 'برنامج البورتج'

        ]);
        return $res ;
    }

    public function child_tests($child_id)  {

        $child = TestResault::where('child_id'  ,  $child_id)
        ->orderby('created_at' , 'desc')->first() ;

        $res = null ;

        if($child)
            $res =new  TestsChildResource($child);


        else
            $res = '-1' ;

        return response()->json($res , 200);

    }


}
