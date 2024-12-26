<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlans;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WorkoutPlansController extends Controller implements HasMiddleware
{
    static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = WorkoutPlans::all();
        return response()->json($plans, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $field = $request->validate([
            'name' => 'required|string|max:128',
            'description' => "required|max:255",
        ]);

        $workout_plan = $user->workout_plan()->create($field);
        return response()->json($workout_plan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $workout_plan = WorkoutPlans::findOrFail($id);
            return response()->json($workout_plan, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No workout Plan found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $workout_plan = WorkoutPlans::findOrFail($id);
            $field = $request->validate([
                'name' => 'required|string|max:128',
                'description' => "required|max:255",
            ]);
            $updated_workout_plan = $workout_plan->update($field);
            return response()->json($updated_workout_plan, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No workout Plan found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $workout_plan = WorkoutPlans::findOrFail($id);
            $workout_plan->delete();
            return response()->json(['message' => 'workout Plan deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No workout Plan found'], 404);
        }
    }
}
