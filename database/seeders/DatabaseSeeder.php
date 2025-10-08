<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OeuvreSeeder::class,
            ParcoursSeeder::class,
            MediaSeeder::class,
            AvisSeeder::class,
            VisiteSeeder::class,
            CategorySeeder::class,
            OeuvreParcoursSeeder::class,
            UserSeeder::class,
            GalerieSeeder::class,
        ]);
    }
}
