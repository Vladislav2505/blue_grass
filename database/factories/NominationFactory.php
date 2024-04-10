<?php

namespace Database\Factories;

use App\Models\Nomination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Nomination>
 */
class NominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
