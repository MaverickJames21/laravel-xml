<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BilledFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'billed' => $this->faker->sentence(),
            'paid' => $this->faker->date(),
            'billing_date' => $this->faker->date(),

        ];
    }
}
