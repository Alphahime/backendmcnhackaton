<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parcours;
use Illuminate\Support\Facades\DB;

class ParcoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parcours = [
            [
                'title' => 'Arts et Traditions Sénégalaises',
                'description' => 'Découvrez la richesse culturelle du Sénégal à travers ses masques, statues et objets traditionnels utilisés dans les cérémonies et la vie quotidienne.',
                'image_url' => 'https://medias.gazette-drouot.com/prod/medias/mediatheque/15463.jpg',
                'difficulty' => 'facile',
                'estimated_duration' => 45,
                'target_audience' => 'adultes',
                'is_featured' => true,
                'order' => 1,
                'themes' => json_encode(['art', 'tradition', 'culture', 'cérémonie'])
            ],
            [
                'title' => 'Textiles et Artisanat Africain',
                'description' => 'Explorez l\'art du tissage, de la teinture et de la broderie à travers les magnifiques textiles et objets artisanaux d\'Afrique de l\'Ouest.',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3e8r9qaNGiSoPOjvI1gnbvcZZPsi0xcnw3A&s',
                'difficulty' => 'facile',
                'estimated_duration' => 60,
                'target_audience' => 'adultes',
                'is_featured' => true,
                'order' => 2,
                'themes' => json_encode(['textile', 'artisanat', 'couleurs', 'technique'])
            ],
            [
                'title' => 'Trésors Royaux d\'Afrique',
                'description' => 'Parcourez l\'histoire des royaumes africains à travers leurs trônes, sceptres et objets de pouvoir symbolisant l\'autorité royale.',
                'image_url' => 'https://media.lesechos.com/api/v1/images/view/5ee37d8bd286c2493278aedd/1280x720/2249111-tresors-de-lart-africain-a-bruxelles-web-tete-060816692563.jpg',
                'difficulty' => 'moyen',
                'estimated_duration' => 75,
                'target_audience' => 'adultes',
                'is_featured' => true,
                'order' => 3,
                'themes' => json_encode(['royauté', 'pouvoir', 'histoire', 'empire'])
            ],
            [
                'title' => 'Art Sacré et Rituels',
                'description' => 'Plongez dans la spiritualité africaine à travers les objets rituels, les masques sacrés et les artefacts utilisés dans les pratiques religieuses traditionnelles.',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwoylmYfk1rHq-fsLHSvxS9z8DYCE0BebQsg&s',
                'difficulty' => 'moyen',
                'estimated_duration' => 90,
                'target_audience' => 'adultes',
                'is_featured' => false,
                'order' => 4,
                'themes' => json_encode(['religion', 'spiritualité', 'rituel', 'sacré'])
            ],
            [
                'title' => 'Aventure des Petits Explorateurs',
                'description' => 'Parcours ludique et éducatif spécialement conçu pour les enfants avec des énigmes et des découvertes interactives.',
                'image_url' => 'https://journals.openedition.org/ocim/docannexe/image/4717/img-1-small480.jpg',
                'difficulty' => 'facile',
                'estimated_duration' => 30,
                'target_audience' => 'enfants',
                'is_featured' => true,
                'order' => 5,
                'themes' => json_encode(['jeu', 'découverte', 'famille', 'interactif'])
            ]
        ];

        foreach ($parcours as $parcour) {
            Parcours::create($parcour);
        }
    }
}