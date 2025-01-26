<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('test'),
            'role_id' => '1',
        ]);

        User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'password' => Hash::make('test'),
            'role_id' => '2',
        ]);

        $user = User::factory(10)->create(); // Create a test user

    }
}
