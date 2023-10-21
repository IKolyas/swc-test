<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{

    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(),
            'user_id' => User::all()->first()->id,
        ];
    }
}