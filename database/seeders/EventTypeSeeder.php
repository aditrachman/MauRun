<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => '3K', 'slug' => '3k'],
            ['name' => '5K', 'slug' => '5k'],
            ['name' => '10K', 'slug' => '10k'],
            ['name' => 'Half Maraton', 'slug' => 'half_maraton'],
            ['name' => 'Full Maraton', 'slug' => 'full_maraton'],
        ];

        foreach ($types as $type) {
            EventType::create($type);
        }
    }
}
