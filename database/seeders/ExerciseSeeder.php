<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercise::create([
            'name' => 'Push-ups',
            'description' => 'A bodyweight exercise for strengthening chest and arms',
            'category' => 'strength'
        ]);

        Exercise::create([
            'name' => 'Jumping Jack',
            'description' => 'A bodyweight exercise for strengthening chest and arms',
            'category' => 'cardio'
        ]);

        Exercise::create([
            'name' => 'Sit-ups',
            'description' => 'A bodyweight exercise for strengthening chest and arms',
            'category' => 'flexibility'
        ]);
    }
}
