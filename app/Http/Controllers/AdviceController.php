<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Http\Controllers\API\BaseController;
use App\Models\Advice;
use App\Http\Requests\StoreAdviceRequest;
use App\Http\Requests\UpdateAdviceRequest;
use App\Http\Resources\Boshra\AdviceResource;
use App\Models\Child;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdviceController extends BaseController
{

    public function index()
    {
        $advice = Advice::all() ;
        if($advice)
        {
            return $this->sendResponse(AdviceResource::collection($advice) , "this is all advice..");
        }
        return $this->sendErrors([] , 'error in retrived all advice' ) ;
    }

    public function myAdvice($child_id)
    {
        $advice = Advice::where('child_id' , $child_id)->get() ;
        if($advice)
        {
            return $this->sendResponse(AdviceResource::collection($advice) , "this is all advice..");
        }
        return $this->sendErrors([] , 'error in retrived all advice' ) ;
    }

    public function store(Request $request)
    {
        $advice = Advice::create([

            'child_id' => $request->child_id ,
            'text' => $request->text
        ]);
        $advice_id=Advice::where('child_id',$request->child_id)->value("id");
        if($advice)
        {
            broadcast(new NotificationEvent("ارسال نصيحه",  "تم ارسال بعض النصائح لطفلكم",$request->child_id,$advice_id));
            $realTime = Notification::create([
                'title' => "ارسال نصيحه",
                'receiver_id' =>$request->child_id,
                'message' => "تم ارسال بعض النصائح لطفلكم",

            ]);
            $realTime->save();
            return $this->sendResponse($advice , "success in add advice..");
        }
        return $this->sendErrors([] , 'error in added advice' ) ;
    }

    public function details_advice($advice_id )
    {
        $text=Advice::where('id' , $advice_id)->get();
        return $this->sendResponse(AdviceResource::collection($text) , 'success in get advice info') ;

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
