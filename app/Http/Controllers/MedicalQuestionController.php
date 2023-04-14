<?php

namespace App\Http\Controllers;

use App\Models\MedicalQuestion;
use App\Http\Requests\StoreMedicalQuestionRequest;
use App\Http\Requests\UpdateMedicalQuestionRequest;

class MedicalQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ques = MedicalQuestion::all();
        return response()->json($ques, 200);
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
    public function store(StoreMedicalQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalQuestion $medicalQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalQuestion $medicalQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalQuestionRequest $request, MedicalQuestion $medicalQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalQuestion $medicalQuestion)
    {
        //
    }
}
