<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workout_exercises() {
        return $this->hasMany(WorkoutExercise::class);
    }
}
