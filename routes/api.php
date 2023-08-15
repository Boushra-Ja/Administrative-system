    <?php

use App\Http\Controllers\AdviceController;
use App\Http\Controllers\AppointmentController;
    use App\Http\Controllers\BounsController;
    use App\Http\Controllers\ChildController;
    use App\Http\Controllers\DiseasesController;
    use App\Http\Controllers\LevelController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\PersonalQuestionController;
    use App\Http\Controllers\TaskController;
    use App\Http\Controllers\TestResaultController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ViewController;
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

Route::put('educational_answer', [App\Http\Controllers\EductionalConditionController::class, 'show']);
Route::put('medical_answer', [App\Http\Controllers\MedicalConditionController::class, 'show']);

Route::post('done_Education_Medical', [App\Http\Controllers\TitelsController::class, 'done_Education_Medical']);

///////////////////

    Route::resource('child', ChildController::class);
    Route::get('personal_question/all', [PersonalQuestionController::class, 'index']);
    Route::get('child/show/{id}', [ChildController::class, 'show']);
    Route::resource('personal_info', PersonalInformationController::class)->except('show', 'index', 'update');
    Route::post('update_child_info', [PersonalInformationController::class, 'update_child']);
    Route::get('employee/tasks/{id}', [TaskController::class, 'tasks_Employee']);
    Route::post('task/terminate/{id}', [TaskController::class, 'finish_task']);
    ////php artisan migrate --path="database/migrations/2023_04_14_062044_create_titels_table.php"
    Route::get('childs/names', [ChildController::class, 'child_names']);
    Route::post('parent/login', [ChildController::class, 'loginParent']);
    Route::resource('advice', AdviceController::class)->except('edit', 'show', 'create', 'update');
    Route::get('advice/child/{id}', [AdviceController::class, 'myAdvice']);
    Route::post('Report/{id}', [ChildController::class, 'Report']);
    Route::get('child/test/{id}', [ChildController::class, 'child_tests']);
    Route::get('Employees/order/tasks', [UserController::class, 'Employees_order_tasks']);
    Route::get('Employees/order/points', [UserController::class, 'Employees_order_points']);
    Route::get('Employees/all', [UserController::class, 'show_Employee']);
    Route::get('employee/notifications/{id}', [NotificationController::class, 'all_employee_notifications']);
    Route::get('parent/notifications/{id}', [NotificationController::class, 'all_parent_notifications']);
    Route::get('admin/notifications/{id}', [NotificationController::class, 'all_admin_notifications']);
    Route::post('emp/register', [UserController::class, 'employee_register']);
    Route::post('emp/login', [UserController::class, 'employee_login']);
    Route::post('store/resault', [TestResaultController::class, 'store_res']);
    Route::get('child/appoinments/{id}', [AppointmentController::class, 'my_appinments']);
    Route::post('connect/between/sys3', [TestResaultController::class,'connect_between_sys3']);
    Route::get('report/numbers', [ViewController::class,'report_numbers']);


////@batoul///

    Route::post('LoginAdmin' , [UserController::class , 'LoginAdmin']) ;


    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::post('AddEmployee' , [UserController::class , 'AddEmployee'])
            ->middleware('Role');

        Route::post('AddSpecialist' , [UserController::class , 'AddSpecialist'])
            ->middleware('Role');


        Route::post('Store_Appointment', [AppointmentController::class,'Store_Appointment']);
         // ->middleware('Role');

           // ->middleware('Role');

        Route::get('show_MyTasks', [TaskController::class,'show_MyTasks']);

        Route::post('update_Task/{id}', [TaskController::class,'update_Task']);
          //  ->middleware('Role');

        Route::get('Show_appointment', [AppointmentController::class,'Show_appointment']);
         //   ->middleware('Role');

           // ->middleware('Role');


        Route::get('show_Specialist', [UserController::class,'show_Specialist'])
            ->middleware('Role');
        Route::get('show_Employee', [UserController::class,'show_Employee']);
    });



    Route::get('show_MyTasks_id/{id}', [TaskController::class,'show_MyTasks_id']);
    Route::post('delete_appointment/{id}', [TaskController::class,'delete_appointment']);
    Route::delete('delete_SpecOrEmp/{id}', [UserController::class,'delete_SpecOrEmp']);
    Route::get('AllUser', [UserController::class,'AllUser']);


    Route::get('All_Diseases/{myArray}', [ViewController::class,'All_Diseases']);
    Route::get('All_level/{myArray}', [ViewController::class,'All_level']);
    Route::post('add_Diseases', [DiseasesController::class,'add_Diseases']);
    Route::get('All_Infections/{myArray}', [ViewController::class,'All_Infections']);
    Route::get('MatchingList/{myArray}/{id}', [ViewController::class,'MatchingList']);
    Route::post('store_test', [TestResaultController::class,'store_test']);


    Route::post('/alert', [NotificationController::class, 'alert']);


    Route::get('details_ِApp/{id}', [AppointmentController::class,'details_ِApp']);
    Route::get('ShowLevel', [LevelController::class,'index']);
    Route::get('ShowDiseases', [DiseasesController::class,'index']);
    Route::get('details_advice/{id}', [AdviceController::class,'details_advice']);
    Route::post('StoreAdvice', [AdviceController::class,'store']);
    Route::get('details_ِbouns/{id}', [BounsController::class,'details_ِbouns']);
    Route::post('storeBouns', [BounsController::class,'storeBouns']);
    Route::get('task/details/{id}', [TaskController::class,'details_task']);



    Route::post('Store_Task', [TaskController::class,'Store_Task']);
    Route::get('Show_Phones', [AppointmentController::class,'Show_Phones']);
