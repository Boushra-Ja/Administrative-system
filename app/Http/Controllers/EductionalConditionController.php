<?php

namespace App\Http\Controllers;

use App\Http\Resources\bayan\Education_AResource;
use App\Http\Resources\bayan\Education_QResource;
use App\Models\EductionalCondition;
use App\Http\Requests\StoreEductionalConditionRequest;
use App\Http\Requests\UpdateEductionalConditionRequest;
use App\Models\Titels;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;


class EductionalConditionController extends Controller
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
    public function store(Request $request)
    {

        foreach ($request->ans as $item) {

            $answers = EductionalCondition::create([
                'child_id' => $request->child_id,
                'ques_id' => $item['ques_id'],
                'answer'=>$item['answer']
                ]
            );
        }
        if ($request->has('center')) {
            $center = CenterController::store($request->center, $request->child_id);
        }
        if ($answers )
        return response()->json($answers, 200);

        return response()->json([], 201);

    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $edu = Titels::where('type', '=', 'e')->get();
        $d= Education_AResource::collection($edu);
        return response()->json($d, 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EductionalCondition $eductionalCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEductionalConditionRequest $request, EductionalCondition $eductionalCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EductionalCondition $eductionalCondition)
    {
        //
    }
}
