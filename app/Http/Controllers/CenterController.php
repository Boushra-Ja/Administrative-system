<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public Static function store($request,$child_id)
    {
        $center = null ;

        foreach ($request as $item) {

            $center = Center::create(
                [
                    'child_id' => $child_id,
                    'center_name' => $item['center_name'],
                    'diagnosis' => $item['diagnosis'],
                    'specialist' => $item['specialist'],
                    'qualification' => $item['qualification'],
                    'qualification_axes' => $item['qualification_axes'],
                    'time' => $item['time'],

                ]
            );
        }

         return $center;

    }


    public Static function show($child_id)
    {
        $center = Center::where('child_id',$child_id)->get();

         return $center;

    }
}
