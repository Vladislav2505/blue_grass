<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->name();

        $path = 'tmp/files/1.docx';

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'date' => $this->faker->date(),
            'file' => $path,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
