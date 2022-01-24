<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => str::random(200),
            'user_id' => $this->faker->numberBetween(1,User::count()),
            'client_id' =>$this->faker->numberBetween(1,Client::count()),
            'project_id' =>$this->faker->numberBetween(1,Project::count()),
            'deadline' =>$this->faker->date(),
            'status' =>$this->faker->randomElement(['open','blocked','in progress','pending','cancelled','completed'])
        ];
    }
}
