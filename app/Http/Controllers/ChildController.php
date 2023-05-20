<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Resources\Boshra\ChildResourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildController extends BaseController
{

    public function index_by_age()
    {
        $child=Child::orderBy('age', 'Asc')->get()->toArray();
        return response()->json($child, 200);
    }

    public function index_by_section($section)
    {
        $child=Child::where('section','=',$section)->get();
        return response()->json($child, 200);
    }

    public function index_by_infection($infection)
    {
        $child=Child::where('infection','=',$infection)->get();
        return response()->json($child, 200);
    }


    public function index()
    {
        $child=Child::all();
        return response()->json($child, 200);
    }

    public function child_names()
    {
        $childs = Child::all(['id' , 'name']);

        if($childs){
            return $this->sendResponse($childs, 'this is all children');
        }
        return $this->sendErrors([], 'error in fetch all children');

    }
    public function store(StoreChildRequest $request)
    {
        $dateOfBirth = $request->age;
        $unique_num = random_int(100, 999999) ;
        $check  = Child::where('unique_number' , $unique_num)->first() ;
        while($check)
        {
            $unique_num = random_int(100, 999999) ;
            $check  = Child::where('unique_number' , $unique_num)->first() ;
        }

        $years = (int)Carbon ::parse($dateOfBirth)->diff(Carbon::now())->format('%y') ;
        $months = (int)Carbon ::parse($dateOfBirth)->diff(Carbon::now())->format('%m') ;

        $age = ($years * 12 )+ $months ;

        $child = Child::create([
            'name' => $request->name,
            'phone_num' => $request->phone_number,
            'age' => $age ,
            'unique_number' => $unique_num

        ]);


        if($child){
            return $this->sendResponse($child, 'success in add a child');
        }
        return $this->sendErrors([], 'failed in added child');

    }


    public function show($id)
    {

        $child = Child::where('id' , $id) ->get() ;
        return $this->sendResponse(ChildResourse::collection($child), "this is all information for child");

    }



    public function update(UpdateChildRequest $request, Child $child)
    {
        //
    }


    public function destroy($id)
    {
        $child = Child::where('id', '=', $id)->delete();
        if($child)
        {
            $this->sendResponse($child , 'the child is deleted ') ;
        }
        $this->sendErrors([] , 'failed in the delete child') ;


    }
        public function loginParent(Request $request)
        {

            $child = Child::where('unique_number' , $request->unique_number)->first() ;
            if($child)
            {
                return $this->sendResponse([$child] , 'login success') ;
            }
            return $this->sendErrors([] , 'the user is not registered...');
        }
    }

