<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        if (config('app.env') !== 'production') {
            $this->call([
                ProfileSeeder::class,
                ThemeSeeder::class,
                LocationSeeder::class,
                EventNominationSeeder::class,
                ProtocolSeeder::class,
                PartnerSeeder::class,
                CollectionSeeder::class,
                NewsSeeder::class,
            ]);
        }
    }
}
