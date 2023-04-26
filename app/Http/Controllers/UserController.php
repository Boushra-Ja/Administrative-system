<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(Request $request)
    {

        $Email1='amira@gmail.com';
        $Email2='razi@gmail.com';
        $valid = $request->validate([
            'email' => 'required',
            'unique_number'=>'required',
            'role'=>'required',

        ]);

        $user = User::where('email', $valid['email'])->first();

        try {



        if ($valid['unique_number'] == 1111 && $valid['role']== 'role' )
            if($valid['email'] == $Email1 || $valid['email'] == $Email2  )
                      $check = true;
        if (!$check) {
            return response()->json(['message' => 'Login problem']);
        } else {
            $token = $user->createToken('ProductsTolken')->plainTextToken;
            return response()->json([
                  'user' => $user,
                  'token' => $token,
            ]);
        }}
        catch (Exception $exception ){
            return response()->json(['message' => 'Your information is not true !! you are not Admin ']);

        }
    }
}
