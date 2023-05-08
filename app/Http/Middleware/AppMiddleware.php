<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppMiddleware
{

//    public function handle(Request $request, Closure $next): Response
//    {
//        return $next($request);
//    }


    public function handle($request, Closure $next) {
            if(auth()->user()->role=='admin'){

            return $next($request);}


    else
          return response()->json([
            'message'=>'Sorry !! you are not admin',

        ]);
}}

