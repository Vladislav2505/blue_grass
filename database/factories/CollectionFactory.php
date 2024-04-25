<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JsonException;

/**
 * @extends Factory<Event>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws JsonException
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'images' => json_encode($this->faker->imageUrl(), JSON_THROW_ON_ERROR),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
