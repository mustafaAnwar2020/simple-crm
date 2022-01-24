<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => $this->faker->numberBetween(2,50),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'contact' => $this->faker->url()
        ];
    }
}
