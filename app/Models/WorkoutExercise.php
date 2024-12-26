<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    protected $fillable = [
        'sets',
        'repetitions',
        'distance',
        'weight'
    ];

    public function workout_plan()
    {
        return $this->belongsTo(WorkoutPlans::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
