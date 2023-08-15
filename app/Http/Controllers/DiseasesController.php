<?php

namespace App\Http\Controllers;

use App\Models\Diseases;
use Illuminate\Http\Request;

class DiseasesController extends Controller
{


    public function index()
    {

        $diseases = Diseases::query()->get();
        return response()->json($diseases, 200);
    }

    public function add_Diseases(Request $request){


        $valid = $request->validate([
            'name' => 'required ',]);

        $tt = Diseases::create([
            'name' => $valid['name'],]);


        return response()->json([
            'message' => 'A name has been inserted successfully',
            'Task' => $tt,
        ]);

    }


}
