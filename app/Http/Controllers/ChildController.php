<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use Illuminate\Http\Request;


class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function store(StoreChildRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Child $child)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildRequest $request, Child $child)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child)
    {
        //
    }
}
