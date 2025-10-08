<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Avis;
class AvisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avis::create([
            'user_id' => 1,
            'oeuvre_id' => 1,
            'commentaire' => 'Très belle œuvre, très représentative de la culture sénégalaise.',
            'note' => 5,
        ]);

        Avis::create([
            'user_id' => 2,
            'oeuvre_id' => 2,
            'commentaire' => 'J’adore la finesse de la sculpture.',
            'note' => 4,
        ]);

        Avis::create([
            'user_id' => 1,
            'oeuvre_id' => 3,
            'commentaire' => 'Les couleurs sont magnifiques et le tissu est très authentique.',
            'note' => 5,
        ]);
    }
}
