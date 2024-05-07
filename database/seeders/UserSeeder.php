<?php

namespace Database\Seeders;

use App\Models\Profile;
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
        $adminUser = User::create([
            'email' => config('site.admin_email'),
            'password' => Hash::make('123123q-'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        Profile::query()->create([
            'user_id' => $adminUser->id,
            'last_name' => 'Admin',
            'first_name' => 'admin',
        ]);

//        User::factory(20)->create();
    }
}
