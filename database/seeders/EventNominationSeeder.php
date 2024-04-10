<?php

namespace Database\Seeders;

use App\Models\EventNomination;
use Illuminate\Database\Seeder;

class EventNominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventNomination::factory(20)->create();
    }
}
