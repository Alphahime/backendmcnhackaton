<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visite;
class VisiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visite::create([
            'user_id' => 1,
            'oeuvre_id' => 1,
            'visited_at' => now()->subDays(2),
        ]);

        Visite::create([
            'user_id' => 2,
            'oeuvre_id' => 2,
            'visited_at' => now()->subDays(1),
        ]);

        Visite::create([
            'user_id' => 1,
            'oeuvre_id' => 3,
            'visited_at' => now(),
        ]);
    }
}
