<?php

namespace App\Http\Controllers;

use App\Models\WorkoutExercise;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorkoutPlan $workoutPlan)
    {
        $workout_exercise = $workoutPlan->workout_exercises;
        return response()->json($workout_exercise, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, WorkoutPlan $workoutPlan)
    {
        $field = $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'sets' => 'required|integer',
            'repetitions' => 'required|integer',
            'distance' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $workout_plan_exercise = $workoutPlan->workout_exercises()->create($field);
        return response()->json($workout_plan_exercise, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkoutPlan $workoutPlan, WorkoutExercise $workout_exercise)
    {
        try {
            $workout_plan_exercise = $workoutPlan->workout_exercises()->where('id', $workout_exercise->id)->first();
            return response()->json($workout_plan_exercise, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No Workout Exercise Plan was found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkoutPlan $workoutPlan, WorkoutExercise $workout_exercise)
    {
        try {
            $field = $request->validate([
                'exercise_id' => 'required|exists:exercises,id',
                'sets' => 'required|integer',
                'repetitions' => 'required|integer',
                'distance' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);
            $workout_plan_exercise = $workoutPlan->workout_exercises()->where('id', $workout_exercise->id)->first();
            $updated_workout_plan_exercise = $workout_plan_exercise->update($field);
            return response()->json($updated_workout_plan_exercise, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No workout Exercise found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutPlan $workoutPlan, WorkoutExercise $workout_exercise)
    {
        try {
            $workout_plan_exercise = $workoutPlan->workout_exercises()->where('id', $workout_exercise->id);
            $workout_plan_exercise->delete();
            return response()->json(['message' => 'workout Exercise deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No workout Exercise found'], 404);
        }
    }
}
