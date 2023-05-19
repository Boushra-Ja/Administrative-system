    <?php

    use App\Http\Controllers\AppointmentController;
    use App\Http\Controllers\ChildController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\PersonalQuestionController;
    use App\Http\Controllers\TaskController;
    use App\Http\Controllers\UserController;
    use App\Models\PersonalInformation;
use App\Models\PersonalQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('index_by_age', [App\Http\Controllers\ChildController::class, 'index_by_age']);
Route::get('index_by_section/{section}', [App\Http\Controllers\ChildController::class, 'index_by_section']);
Route::get('index_by_infection/{infection}', [App\Http\Controllers\ChildController::class, 'index_by_infection']);

Route::get('educational_title_index', [App\Http\Controllers\TitelsController::class, 'educational_title_index']);
Route::get('medical_title_index', [App\Http\Controllers\TitelsController::class, 'medical_title_index']);
Route::post('medical_store', [App\Http\Controllers\MedicalConditionController::class, 'store']);
Route::post('educational_store', [App\Http\Controllers\EductionalConditionController::class, 'store']);

Route::post('educational_answer', [App\Http\Controllers\EductionalConditionController::class, 'show']);
Route::post('medical_answer', [App\Http\Controllers\MedicalConditionController::class, 'show']);

Route::post('done_Education_Medical', [App\Http\Controllers\TitelsController::class, 'done_Education_Medical']);

///////////////////

Route::resource('child' , ChildController::class) ;
Route::get('personal_question/all' , [PersonalQuestionController::class , 'index']) ;
Route::get('child/show/{id}' , [ChildController::class , 'show']) ;
Route::resource('personal_info' , PersonalInformationController::class)->except('show' , 'index' , 'update') ;
Route::post('update_child_info' , [PersonalInformationController::class , 'update_child']);
Route::get('employee/tasks/{id}' , [TaskController::class , 'tasks_Employee']) ;
Route::post('task/terminate/{id}' , [TaskController::class , 'finish_task']) ;
////php artisan migrate --path="database/migrations/2023_04_14_062044_create_titels_table.php"
Route::get('childs/names' , [ChildController::class , 'child_names']) ;



    ////@batoul///

    Route::post('LoginAdmin' , [UserController::class , 'LoginAdmin']) ;

    Route::post('Login_Other' , [UserController::class , 'LoginEmployeeOrSpecialist']) ;


    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('AddEmployee' , [UserController::class , 'AddEmployee'])
            ->middleware('Role');

        Route::post('AddSpecialist' , [UserController::class , 'AddSpecialist'])
            ->middleware('Role');


        Route::post('Store_Appointment', [AppointmentController::class,'Store_Appointment'])
          ->middleware('Role');

        Route::post('Store_Task', [TaskController::class,'Store_Task'])
            ->middleware('Role');

        Route::get('show_MyTasks', [TaskController::class,'show_MyTasks']);

        Route::post('update_Task/{id}', [TaskController::class,'update_Task'])
            ->middleware('Role');

        Route::get('Show_appointment', [AppointmentController::class,'Show_appointment'])
            ->middleware('Role');

        Route::get('Show_Phones', [AppointmentController::class,'Show_Phones'])
            ->middleware('Role');

        Route::get('show_Employee', [UserController::class,'show_Employee'])
            ->middleware('Role');

        Route::get('show_Specialist', [UserController::class,'show_Specialist'])
            ->middleware('Role');




    });

    Route::get('show_MyTasks_id/{id}', [TaskController::class,'show_MyTasks_id']);
    Route::get('AllUser', [UserController::class,'AllUser']);

