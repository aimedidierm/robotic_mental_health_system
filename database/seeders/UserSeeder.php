<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Default Admin',
            'email' => 'test@example.com',
            'phone' => '0788750979',
            'role' => 'admin',
            'password' => bcrypt('0788750979'),
        ]);
    }
}
