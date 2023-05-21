<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Advice;
use App\Http\Requests\StoreAdviceRequest;
use App\Http\Requests\UpdateAdviceRequest;

class AdviceController extends BaseController
{

    public function index()
    {
        $advice = Advice::all() ;
        if($advice)
        {
            return $this->sendResponse($advice , "this is all advice..");
        }
        return $this->sendErrors([] , 'error in retrived all advice' ) ;
    }

    public function myAdvice($child_id)
    {
        $advice = Advice::where('child_id' , $child_id)->get() ;
        if($advice)
        {
            return $this->sendResponse($advice , "this is all advice..");
        }
        return $this->sendErrors([] , 'error in retrived all advice' ) ;
    }

    public function store(StoreAdviceRequest $request)
    {
        $advice = Advice::create([

            'child_id' => $request->child_id ,
            'text' => $request->text
        ]) ;
        if($advice)
        {
            return $this->sendResponse($advice , "success in add advice..");
        }
        return $this->sendErrors([] , 'error in added advice' ) ;
    }

    public function destroy($id)
    {
        $child = Advice::where('id', '=', $id)->delete();
        if($child)
        {
            $this->sendResponse($child , 'the advice is deleted...') ;
        }
        $this->sendErrors([] , 'failed in the delete advice...') ;
    }
}
