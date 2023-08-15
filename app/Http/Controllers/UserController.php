<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\LoginOtherRequest;
use App\Http\Resources\AllUsersResource;
use App\Http\Resources\Boshra\EmployeeResource;
use App\Models\Appointment;
use App\Models\Level;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
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
            'password' => 'required',
            'role' => 'required',

        ]);

        $user = User::where('email', $valid['email'])->first();

        try {



            if ($valid['password'] == 1111 && $valid['role'] == 'admin')
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

        $valid = $request->validate([
            'email' =>'required|email|unique:users',
            'name' => 'required',
            'scientific_level'=> 'required',


        ]);

        $userEmp =  User::create([
            'name' => $valid['name'],
            'role' => 'Employee',
            'scientific_level'=> $valid['scientific_level'],
            'email' => $valid['email'],
            'points' => 0


        ]);
        $token = $userEmp->createToken('ProductsTolken')->plainTextToken;
        if ($userEmp){
            $g = Level::query()->where('name', '=', $valid['scientific_level'])->value('id');
                (new  ViewController)->Store_repot($g);


            return response()->json([
                'message' => 'Store employee successfully',
                'user' => $userEmp,
                'token' => $token,
            ]);

        }

        else {
            return $this->sendErrors('failed in Store user', ['error' => 'not true']);
        }
    }

    ///اضافة اخصائي///
    function AddSpecialist(Request $request)
    {
        $valid = $request->validate([
            'email' =>'required|email|unique:users',
            'name' => 'required',
        ]);



        $userSpecialist =  User::create([
            'name' => $valid['name'],
            'role' => 'Specialist',
            'scientific_level'=> 'اخصائي',

            'email' => $valid['email'],
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
        {
            $tasks = Task::where('user_id',  $id)->get() ;
            foreach ($tasks as $task) {
                Appointment::where('id' , $task['app_id'])->delete() ;
            }

            User::where('id', '=', $id)->delete();

            return response()->json([
                'message'=>'This user has been deleted successfully',
            ]);
        }

    }

    public function Employees_order_tasks()
    {
        $employees = DB::table('users')
        ->join('tasks', 'tasks.user_id', '=', 'users.id')
        ->select('users.id as id', DB::raw("count(tasks.user_id) as count" , 'tasks.check') )
        ->where('tasks.check' , 1)
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



    public function employee_register(Request $request)  {

        $emp = User::where('email' , $request->email)->where('role' , $request->role)->first() ;

        if(!$emp)
        {
            return $this->sendErrors([] , 'هذا الايميل غير مسجل مسبقاً') ;

        }

        $validatedData = $request->validate([
            'password' => ['required', 'string' ,'min:6' ,'max:12']
        ]);


        $emp2 = User::where('email' , $request->email)->where('role' , $request->role) ;

        $res = $emp2->update([
            'password' => $validatedData['password']
        ]);

        if($res)
        {
            return $this->sendResponse(new EmployeeResource($emp ), 'register success') ;
        }
        return $this->sendErrors([] , 'errror in register employee') ;

    }

    public function employee_login(Request $request)  {

        $emp = User::where('email' , $request->email)
        ->where('password'  ,$request->password )
        ->where('role' , $request->role)->first() ;

        if($emp)
        {
            return $this->sendResponse(new EmployeeResource($emp) , 'login success') ;
        }
        return $this->sendErrors([] , 'errror in login employee') ;
    }

}
