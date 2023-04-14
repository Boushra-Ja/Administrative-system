<?php

namespace App\Http\Controllers;

use App\Models\EductionalQuestion;
use App\Http\Requests\StoreEductionalQuestionRequest;
use App\Http\Requests\UpdateEductionalQuestionRequest;

class EductionalQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ques = EductionalQuestion::all();
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
    public function store(StoreEductionalQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EductionalQuestion $eductionalQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EductionalQuestion $eductionalQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEductionalQuestionRequest $request, EductionalQuestion $eductionalQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EductionalQuestion $eductionalQuestion)
    {
        //
    }
}
