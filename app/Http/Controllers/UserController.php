<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\LoginOtherRequest;
use App\Http\Resources\AllUsersResource;
use App\Http\Resources\Boshra\EmployeeResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class UserController extends  BaseController
{    ///تسجيل دخول ادمن///
    function LoginAdmin(Request $request)
    {

        $Email1 = 'amira@gmail.com';
        $Email2 = 'razi@gmail.com';
        $valid = $request->validate([
            'email' => 'required',
            'unique_number' => 'required',
            'role' => 'required',

        ]);

        $user = User::where('email', $valid['email'])->first();

        try {



            if ($valid['unique_number'] == 1111 && $valid['role'] == 'admin')
                if ($valid['email'] == $Email1 || $valid['email'] == $Email2)
                    $check = true;
            if (!$check) {
                return response()->json(['message' => 'Login problem']);
            } else {
                $token = $user->createToken('ProductsTolken')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ]);
            }
        } catch (Exception $exception) {
            return response()->json(['message' => 'Your information is not true !! you are not Admin ']);
        }
    }

    ///اضافه موظف///
    function AddEmployee(Request $request)
    {





        $userEmp =  User::create([
            'name' => $request->name,
            'unique_number' => random_int(100000, 999999),
            'role' => 'Employee',
            'email' => '-',
            'points' => 0


        ]);
        $token = $userEmp->createToken('ProductsTolken')->plainTextToken;
        if ($userEmp)
            return response()->json([
                'message' => 'Store employee successfully',
                'user' => $userEmp,
                'token' => $token,
            ]);

        else {
            return $this->sendErrors('failed in Store user', ['error' => 'not true']);
        }
    }

    ///اضافة اخصائي///
    function AddSpecialist(Request $request)
    {

        $userSpecialist =  User::create([
            'name' => $request->name,
            'unique_number' => random_int(100000, 999999),
            'role' => 'Specialist',
            'email' => '-',
            'points' => 0


        ]);
        $token = $userSpecialist->createToken('ProductsTolken')->plainTextToken;
        if ($userSpecialist)
            return response()->json([
                'message' => 'Store Specialist successfully',
                'user' => $userSpecialist,
                'token' => $token,
            ]);

        else {
            return $this->sendErrors('failed in Store user', ['error' => 'not true']);
        }
    }

    ///  تسجيل دخول موظف او اخصائي  او الأهل///
    function  LoginEmployeeOrSpecialist(LoginOtherRequest $request)
    {
        $user = User::where('unique_number', $request->unique_number)->where('role' , $request->role )->first();

        if($user)
        {
            $token = $user->createToken('ProductsTolken')->plainTextToken;


           return $this->sendResponse([new EmployeeResource($user)], "login " . $request->role . " successfuly") ;
        }
        return $this->sendErrors([] , ' login failed') ;
    }

    ///عرض جميع الموظفين في الجمعيه//
    public function show_Employee()
    {

        $Emp= User::where('role', '=', 'Employee')->get();
        return $this->sendResponse(EmployeeResource::collection($Emp) , 'this is all employees ordered by tasks') ;
    }
    ///عرض جميع الاخصائين في الجمعيه//

    public function show_Specialist()
    {
        $Spe= User::where('role', '=', 'Specialist')->get();
        return response()->json($Spe, 200);
    }

    public function delete_SpecOrEmp($id)
    {
        if($id==1 || $id==2)
        {

            return response()->json([
                'message'=>'This user cannot be deleted.... This id  is for the admin ',
            ]);
        }
        else
        {User::where('id', '=', $id)->delete();
            return response()->json([
                'message'=>'This user has been deleted successfully',
            ]);}

    }

    public function Employees_order_tasks()
    {
        $employees = DB::table('users')
        ->join('tasks', 'tasks.user_id', '=', 'users.id')
        ->select('users.id as id', DB::raw("count(tasks.user_id) as count" , 'tasks.check') )
        ->where('tasks.check' , 0)
        ->groupBy('users.id')
        ->orderBy('count' , 'Desc')
        ->get();

        if(isEmpty($employees))
        {
            return $this->sendResponse(EmployeeResource::collection(User::where('role' , 'Employee')->get()) , 'this is all employees ordered by tasks') ;
        }
        else if(!isEmpty($employees)) {
            return $this->sendResponse(EmployeeResource::collection($employees) , 'this is all employees ordered by tasks') ;

        }
        return $this->sendErrors([] , 'error in retrive all employees') ;
    }


    public  function AllUser(){

        $model = User::where('role','=','Employee')->Orwhere('role','=' ,'Specialist')->get();
        return response()->json(AllUsersResource::collection($model), 200);


    }


    public function Employees_order_points()
    {
        $employees = User::where('role' ,'=', 'Employee')
        ->orderBy('points', 'Desc')->get() ;

        return $this->sendResponse(EmployeeResource::collection($employees) , 'this is all employees ordered by points') ;
    }

}
