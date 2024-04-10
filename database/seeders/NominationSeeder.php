<?php

namespace Database\Seeders;

use App\Models\Nomination;
use Illuminate\Database\Seeder;

class NominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nomination::factory(20)->create();
    }
}
