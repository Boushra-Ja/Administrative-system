<?php

namespace App\Http\Controllers;

use App\Http\Resources\bayan\Education_QResource;
use App\Http\Resources\bayan\Medical_QResource;
use App\Models\Titels;
use App\Http\Requests\StoreTitelsRequest;
use App\Http\Requests\UpdateTitelsRequest;
use App\Models\EductionalCondition;
use App\Models\MedicalCondition;
use Illuminate\Http\Request;

class TitelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function educational_title_index()
    {
        $edu = Titels::where('type', '=', 'e')->get();
        $d= Education_QResource::collection($edu);
        return response()->json($d, 200);

    }

    public function medical_title_index()
    {
        $med = Titels::where('type', '=', 'm')->get();
        $d= Medical_QResource::collection($med);
         return response()->json($d, 200);

    }


    public function done_Education_Medical(Request $request)
    {

        $done_m=MedicalCondition::where('child_id',$request->id)->first();
        $done_e=EductionalCondition::where('child_id',$request->id)->first();

        if($done_m){
            if($done_e){
                return response()->json([
                    "medical"=>"done",
                    "education"=>"done",], 200);
            }
            return response()->json(["medical"=>"done","education"=>"not"], 200);
        }
        if($done_e)
        return response()->json(["education"=>"done","medical"=>"not"], 200);

        

        return response()->json([
            "medical"=>"not",
            "education"=>"not",], 200);

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
    public function store(StoreTitelsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Titels $titels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Titels $titels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTitelsRequest $request, Titels $titels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Titels $titels)
    {
        //
    }
}
