<?php

namespace App\Http\Controllers;

use App\Models\Titels;
use App\Http\Requests\StoreTitelsRequest;
use App\Http\Requests\UpdateTitelsRequest;

class TitelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Educational_index()
    {
       // $edu=Titels::where()
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
