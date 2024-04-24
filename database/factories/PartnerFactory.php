<?php

namespace Database\Factories;

use App\Models\Nomination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Nomination>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
