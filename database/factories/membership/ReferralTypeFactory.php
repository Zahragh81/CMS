<?php

namespace Database\Factories\membership;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'status' => $this->faker->boolean
        ];
    }
}
