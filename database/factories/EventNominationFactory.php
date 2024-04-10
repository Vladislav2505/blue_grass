<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Nomination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventNomination>
 */
class EventNominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'nomination_id' => Nomination::factory(),
        ];
    }
}
