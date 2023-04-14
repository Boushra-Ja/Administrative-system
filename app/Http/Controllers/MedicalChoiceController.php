<?php

namespace App\Http\Controllers;

use App\Models\MedicalChoice;
use App\Http\Requests\StoreMedicalChoiceRequest;
use App\Http\Requests\UpdateMedicalChoiceRequest;

class MedicalChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ques_id)
    {
        $choice = MedicalChoice::where('med_id', '=', $ques_id)->get();
        return response()->json($choice, 200);
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
    public function store(StoreMedicalChoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalChoice $medicalChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalChoice $medicalChoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalChoiceRequest $request, MedicalChoice $medicalChoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalChoice $medicalChoice)
    {
        //
    }
}
