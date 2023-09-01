<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['title' => 'heartbreak'],
            ['title' => 'Unemployment'],
            ['title' => 'Divorce'],
            ['title' => 'Being orphan'],
            ['title' => 'Other'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
