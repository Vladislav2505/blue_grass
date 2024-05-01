<?php

namespace Database\Factories;

use App\Models\EventNomination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends Factory<EventNomination>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws RandomException
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        $img = random_int(1, 4);
        $path = "tmp/images/$img.png";

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $path,
            'description' => $this->faker->text(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
