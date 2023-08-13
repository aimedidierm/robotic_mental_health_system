<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'System Bot',
            'email' => 'bot@example.com',
            'phone' => '0788750979',
            'role' => 'bot',
            'password' => bcrypt('0788750979'),
        ]);
    }
}
