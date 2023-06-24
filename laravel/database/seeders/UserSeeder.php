<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TEST userだけ
        User::firstOrCreate([
            'id' => 1,
            'name' => 'TEST',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => 'zaq12wsx',
        ]);
    }
}
