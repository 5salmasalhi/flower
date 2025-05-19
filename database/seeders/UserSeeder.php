<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@flower.local',
            'is_admin' => true,
            'password' => bcrypt('admin1234'),
        ]);
        // Utilisateurs de test
        User::factory(10)->create();
    }
}
