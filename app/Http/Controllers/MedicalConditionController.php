<?php

namespace App\Http\Controllers;

use App\Models\MedicalCondition;
use App\Http\Requests\StoreMedicalConditionRequest;
use App\Http\Requests\UpdateMedicalConditionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;


class MedicalConditionController extends Controller
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

            $answers = MedicalCondition::create([
                'child_id' => $request->child_id,
                'ques_id' => $item['ques_id'],
                'answer'=>$item['answer']
                ]
            );
        }
        if ($answers )
        return response()->json($answers, 200);

        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalCondition $medicalCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalCondition $medicalCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalConditionRequest $request, MedicalCondition $medicalCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalCondition $medicalCondition)
    {
        //
    }
}
