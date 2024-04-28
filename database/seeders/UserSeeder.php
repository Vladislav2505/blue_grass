<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'last_name' => 'Admin',
            'first_name' => 'admin',
            'email' => config('site.admin_email'),
            'password' => Hash::make('123123q-'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        User::factory(20)->create();
    }
}
