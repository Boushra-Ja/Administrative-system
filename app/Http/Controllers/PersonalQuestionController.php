<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Boshra\PersonalQuesResource;
use App\Models\PersonalQuestion;

class PersonalQuestionController extends BaseController
{

    public function index()
    {
        $questions = PersonalQuestion::all() ;
        if($questions)
            return $this->sendResponse(PersonalQuesResource::collection($questions), "this is all personal questions");

        return $this->sendErrors([] , 'error in show all personal questions') ;
    }


    public function destroy(PersonalQuestion $personalQuestion)
    {
        //
    }
}
