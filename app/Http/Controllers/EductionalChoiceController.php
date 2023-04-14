<?php

namespace App\Http\Controllers;

use App\Models\EductionalChoice;
use App\Http\Requests\StoreEductionalChoiceRequest;
use App\Http\Requests\UpdateEductionalChoiceRequest;

class EductionalChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ques_id)
    {
        $choice = EductionalChoice::where('edu_id', '=', $ques_id)->get();
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
    public function store(StoreEductionalChoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EductionalChoice $eductionalChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EductionalChoice $eductionalChoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEductionalChoiceRequest $request, EductionalChoice $eductionalChoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EductionalChoice $eductionalChoice)
    {
        //
    }
}
