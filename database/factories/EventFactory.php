<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
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
            'date_of' => $this->faker->dateTime(),
            'image' => $this->faker->imageUrl(),
            'award' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'request_access' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'theme_id' => Theme::query()->inRandomOrder()->first(),
            'location_id' => Location::query()->inRandomOrder()->first(),
        ];
    }
}
