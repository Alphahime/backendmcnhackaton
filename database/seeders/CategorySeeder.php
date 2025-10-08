<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Art Sacré et Rituel',
                'slug' => Str::slug('Art Sacré et Rituel'),
                'description' => 'Objets et artefacts utilisés dans les pratiques religieuses et rituelles traditionnelles',
                'color' => '#8B4513',
                'order' => 1,
            ],
            [
                'name' => 'Sculpture Traditionnelle',
                'slug' => Str::slug('Sculpture Traditionnelle'),
                'description' => 'Œuvres sculpturales représentant la culture et les traditions africaines',
                'color' => '#CD853F',
                'order' => 2,
            ],
            [
                'name' => 'Textiles et Tissus',
                'slug' => Str::slug('Textiles et Tissus'),
                'description' => 'Tissus traditionnels, broderies et vêtements cérémoniels',
                'color' => '#DC143C',
                'order' => 3,
            ],
            [
                'name' => 'Art Royal et Pouvoir',
                'slug' => Str::slug('Art Royal et Pouvoir'),
                'description' => 'Objets symbolisant le pouvoir des royaumes et empires africains',
                'color' => '#FFD700',
                'order' => 4,
            ],
            [
                'name' => 'Art Contemporain Africain',
                'slug' => Str::slug('Art Contemporain Africain'),
                'description' => 'Créations modernes et contemporaines d\'artistes africains',
                'color' => '#4682B4',
                'order' => 5,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}