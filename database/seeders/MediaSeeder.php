<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Media;
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::create([
            'oeuvre_id' => 1,
            'type' => 'image',
            'url' => 'https://example.com/images/masque1.jpg',
        ]);

        Media::create([
            'oeuvre_id' => 1,
            'type' => 'video',
            'url' => 'https://example.com/videos/masque1.mp4',
        ]);

        Media::create([
            'oeuvre_id' => 1,
            'type' => 'audio',
            'url' => 'https://example.com/audio/masque1.mp3',
        ]);

        Media::create([
            'oeuvre_id' => 2,
            'type' => 'image',
            'url' => 'https://example.com/images/statue1.jpg',
        ]);

        Media::create([
            'oeuvre_id' => 3,
            'type' => 'image',
            'url' => 'https://example.com/images/tissu1.jpg',
        ]);

        Media::create([
            'oeuvre_id' => 3,
            'type' => 'video',
            'url' => 'https://example.com/videos/tissu1.mp4',
        ]);
    }
}
