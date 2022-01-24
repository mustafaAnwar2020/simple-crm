<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'company_name' =>$this->faker->company(),
            'company_address' =>$this->faker->address(),
            'company_zip' =>$this->faker->postcode(),
            'company_vat' =>$this->faker->postcode(),
        ];
    }
}
