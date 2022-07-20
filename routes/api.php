<?php

use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('add-student',[StudentController::class,'store']);
Route::get('students',[StudentController::class,'index']);
Route::get('edit-student/{id}',[StudentController::class,'editStudent']);
Route::put('update-student/{id}',[StudentController::class,'updateStudent']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
