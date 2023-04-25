<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
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



    public function store(StoreChildRequest $request)
    {
        $child = Child::create([
            'name' => $request->name,
            'phone_num' => $request->phone_number,
            'age' => $request->age

        ]);


        if($child){
            return $this->sendResponse($child, 'success in add a child');
        }
        return $this->sendErrors([], 'failed in added child');

    }


    public function show(Child $child)
    {
        //
    }



    public function update(UpdateChildRequest $request, Child $child)
    {
        //
    }


    public function destroy(Child $child)
    {
        //
    }
}
