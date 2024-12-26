<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category'
    ];

    public function workout_exercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
}
