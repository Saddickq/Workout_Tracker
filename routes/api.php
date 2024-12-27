<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\WorkoutPlansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource('workout_plans', WorkoutPlansController::class);

Route::get('/workout_plans/{workout_plan}/workout_exercises', [WorkoutExerciseController::class, 'index']);
Route::post('/workout_plans/{workout_plan}/workout_exercises', [WorkoutExerciseController::class, 'store']);
Route::get('/workout_plans/{workout_plan}/workout_exercises/{workout_exercise}', [WorkoutExerciseController::class, 'show']);
Route::put('/workout_plans/{workout_plan}/workout_exercises/{workout_exercise}', [WorkoutExerciseController::class, 'update']);
Route::delete('/workout_plans/{workout_plan}/workout_exercises/{workout_exercise}', [WorkoutExerciseController::class, 'destroy']);
