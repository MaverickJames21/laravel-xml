<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->email;
        return [

        'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'mobile' => $this->faker->imageUrl(),
        'adresse' => $this->faker->word,
        'password' => bcrypt('test1234'),
        'email' => $email
        ];
    }
}
