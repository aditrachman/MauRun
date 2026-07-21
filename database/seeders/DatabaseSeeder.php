<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Master data dulu
        $this->call([EventTypeSeeder::class, CitySeeder::class]);

        // Admin user (penyelenggara)
        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin Mau Run',
            'email' => 'admin@maurun.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Contoh peserta
        User::factory()->create([
            'username' => 'peserta',
            'name' => 'Peserta Demo',
            'email' => 'peserta@maurun.com',
            'password' => bcrypt('password'),
        ]);

        // Helper untuk ambil ID
        $typeId = fn($slug) => EventType::where('slug', $slug)->first()->id;
        $cityId = fn($name) => City::where('name', $name)->first()->id;

        // 4 Event wajib dari soal
        Event::create([
            'name' => 'Grow Run 2026',
            'event_type_id' => $typeId('full_maraton'),
            'date' => '2026-02-15',
            'city_id' => $cityId('Yogyakarta'),
            'price' => 200000,
            'quota' => 2000,
            'description' => 'Benefit: Jersey, BIB number, Medal, Refreshment, Water station, Doorprize',
            'image' => 'events/Grow Run 2026.webp',
        ]);

        Event::create([
            'name' => 'H Run 2026',
            'event_type_id' => $typeId('5k'),
            'date' => '2026-05-28',
            'city_id' => $cityId('Yogyakarta'),
            'price' => 100000,
            'quota' => 5000,
            'description' => 'Benefit: Jersey, BIB number, Medal, Refreshment, Water station, Doorprize',
            'image' => 'events/Hartono Fun Run.webp',
        ]);

        Event::create([
            'name' => 'HRSIY PDHI Fun Run',
            'event_type_id' => $typeId('10k'),
            'date' => '2026-07-08',
            'city_id' => $cityId('Jakarta'),
            'price' => 500000,
            'quota' => 5000,
            'description' => 'Benefit: Jersey, BIB number, Medal, Refreshment, Water station, Doorprize',
            'image' => 'events/RSIY PDHI.webp',
        ]);

        Event::create([
            'name' => 'Sae Run',
            'event_type_id' => $typeId('3k'),
            'date' => '2026-02-08',
            'city_id' => $cityId('Probolinggo'),
            'price' => 400000,
            'quota' => 500,
            'description' => 'Benefit: Jersey, BIB number, Medal, Refreshment, Water station, Doorprize',
            'image' => 'events/Sae Run.webp',
        ]);
    }
}
