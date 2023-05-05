<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\MemberFamily;
use App\Http\Requests\UpdateMemberFamilyRequest;

class MemberFamilyController extends BaseController
{


    public Static function store($request, $child_id)
    {

        foreach ($request as $item) {


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




    public function update(UpdateMemberFamilyRequest $request, MemberFamily $memberFamily)
    {
        //
    }


    public function destroy(MemberFamily $memberFamily)
    {
        //
    }
}
