<?php

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

