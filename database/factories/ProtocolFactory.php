<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class ProtocolFactory extends Factory
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
            'date' => $this->faker->date(),
            'file' => $this->faker->filePath(),
            'is_downloadable' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
