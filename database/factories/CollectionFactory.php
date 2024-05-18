<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends Factory<Event>
 */
class CollectionFactory extends Factory
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
        $images = [];

        for ($i = 0; $i < random_int(1, 10); $i++) {
            $img = random_int(1, 4);
            $images[] = "tmp/images/$img.png";
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'images' => $images,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
