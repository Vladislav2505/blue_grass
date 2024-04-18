<?php

namespace Database\Seeders;

use App\Models\Protocol;
use Illuminate\Database\Seeder;

class ProtocolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Protocol::factory(20)->create();
    }
}
