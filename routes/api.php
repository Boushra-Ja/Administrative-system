    <?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\PersonalQuestionController;
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

Route::get('EductionalQuestion_index', [App\Http\Controllers\EductionalQuestionController::class, 'index']);
Route::get('EductionalChoice_index/{ques_id}', [App\Http\Controllers\EductionalChoiceController::class, 'index']);

Route::get('MedicalQuestion_index', [App\Http\Controllers\MedicalQuestionController::class, 'index']);
Route::get('MedicalChoice_index/{ques_id}', [App\Http\Controllers\MedicalChoiceController::class, 'index']);

Route::get('educational_title_index', [App\Http\Controllers\TitelsController::class, 'educational_title_index']);
Route::get('medical_title_index', [App\Http\Controllers\TitelsController::class, 'medical_title_index']);


///////////////////

Route::resource('child' , ChildController::class) ;
Route::get('personal_question/all' , [PersonalQuestionController::class , 'index']) ;
Route::post('all_personal_info' , [PersonalInformationController::class , 'store']) ;
Route::post('update/personalInfo' , [PersonalInformationController::class , 'update']) ;


////php artisan migrate --path="database/migrations/2023_04_14_062044_create_titels_table.php"
    Route::post('LoginAdmin' , [UserController::class , 'LoginAdmin']) ;
    Route::post('LoginEmployeeOrSpecialist' , [UserController::class , 'LoginEmployeeOrSpecialist']) ;
    Route::post('AddEmployee' , [UserController::class , 'AddEmployee']) ;
    Route::post('AddSpecialist' , [UserController::class , 'AddSpecialist']) ;
