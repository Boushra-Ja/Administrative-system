<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Resources\Boshra\ChildResourse;
use Carbon\Carbon;
use Illuminate\Http\Request;


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

    public function store(StoreChildRequest $request)
    {
        $dateOfBirth = $request->age;

        $years = (int)Carbon ::parse($dateOfBirth)->diff(Carbon::now())->format('%y') ;
        $months = (int)Carbon ::parse($dateOfBirth)->diff(Carbon::now())->format('%m') ;

        $age = ($years * 12 )+ $months ;

        $child = Child::create([
            'name' => $request->name,
            'phone_num' => $request->phone_number,
            'age' => $age

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
}
