<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\MemberFamily;
use App\Http\Requests\UpdateMemberFamilyRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;

class MemberFamilyController extends BaseController
{


    public Static function store($request, $child_id)
    {
        $family = null ;

        foreach ($request as $item) {
            Validator::make($item, [
                'sister_info.name' => 'required',
                'sister_info.gender' => 'required' ,
                'sister_info.age' => 'required|integer' ,
                'sister_info.Educ_level' => 'required|string'
            ]);

            $family = MemberFamily::create(
                [
                    'child_id' => $child_id,
                    'name' => $item['name'],
                    'age' => $item['age'],
                    'gender' => $item['gender'],
                    'Educ_level' => $item['Educ_level']
                ]
            );
        }
        return $family;

    }


    public function show(MemberFamily $memberFamily)
    {
        //
    }




    public static function update(Request $request, $child_id)
    {

    }


    public function destroy(MemberFamily $memberFamily)
    {
        //
    }
}
