<?php
// database/seeders/GalerieOeuvreSeeder.php

namespace Database\Seeders;

use App\Models\GalerieOeuvre;
use Illuminate\Database\Seeder;

class GalerieOeuvreSeeder extends Seeder
{
    public function run(): void
    {
        $oeuvres = [
            [
                'titre' => 'Masque Cérémoniel Traditionnel',
                'description' => 'Masque africain sacré utilisé lors des cérémonies rituelles, sculpté dans du bois précieux et orné de symboles ancestraux.',
                'artiste' => 'Artisanat Traditionnel',
                'annee_creation' => 2020,
                'dimensions' => '45 × 30 cm',
                'image_url' => 'https://afrique.lalibre.be/wp-content/uploads/2024/04/661bf790a0755-Art-Afrique-Met-New-York-787x525.jpg'
            ],
            [
                'titre' => 'Statue Ancestrale en Bronze',
                'description' => 'Sculpture en bronze représentant un ancêtre vénéré, symbole de sagesse et de protection dans la culture africaine.',
                'artiste' => 'Maître Sculpteur',
                'annee_creation' => 2019,
                'dimensions' => '60 × 25 × 20 cm',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBcEp2pRyUKoQk7EJtXEdOWjAwKHwOC8Om-w&s'
            ],
            [
                'titre' => 'Tissu Bogolan Artisanal',
                'description' => 'Textile traditionnel africain tissé et teint à la main selon des techniques ancestrales, aux motifs géométriques symboliques.',
                'artiste' => 'Artisane Textile',
                'annee_creation' => 2021,
                'dimensions' => '200 × 150 cm',
                'image_url' => 'https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=1920,fit=crop/mnl61Wl5gyIG3V2q/dsc_4113-YNqNnewGp7c8bNJb.jpg'
            ],
            [
                'titre' => 'Sculpture sur Bois Yoruba',
                'description' => 'Œuvre sculpturale yoruba représentant des figures mythologiques, témoignage du riche patrimoine artistique nigérian.',
                'artiste' => 'Artiste Yoruba',
                'annee_creation' => 2018,
                'dimensions' => '75 × 40 × 30 cm',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrfU9Y2yynDKuW4-srDc_3maYeGiajp2US9g&s'
            ],
            [
                'titre' => 'Collection d\'Art Royal',
                'description' => 'Ensemble d\'objets royaux africains comprenant des sceptres, couronnes et regalia symbolisant le pouvoir traditionnel.',
                'artiste' => 'Artisans Royaux',
                'annee_creation' => 2022,
                'dimensions' => 'Dimensions variables',
                'image_url' => 'https://img.lemde.fr/2021/04/29/440/0/4558/3034/664/0/75/0/7fdf876_962743818-000-1547yj.jpg'
            ],
            [
                'titre' => 'Masque Dan de Côte d\'Ivoire',
                'description' => 'Masque Dan réputé pour son équilibre esthétique, utilisé lors des cérémonies de jugement et de réconciliation.',
                'artiste' => 'Artisan Dan',
                'annee_creation' => 2020,
                'dimensions' => '38 × 28 cm',
                'image_url' => 'https://s.france24.com/media/display/76966620-40ed-11ec-a244-005056a90284/w:1280/p:16x9/AP21120537636997.jpg'
            ],
            [
                'titre' => 'Art Contemporain Africain',
                'description' => 'Œuvre contemporaine mêlant techniques modernes et symboles traditionnels, reflet de la créativité africaine actuelle.',
                'artiste' => 'Artiste Contemporain',
                'annee_creation' => 2023,
                'dimensions' => '120 × 90 cm',
                'image_url' => 'https://guide.en-vols.com/wp-content/uploads/aftg/2022/06/DKR-toutes-les-facettes-de-l-afrique-au-musee-des-civilisations-noires-2_1-1920x960-3.jpg'
            ],
            [
                'titre' => 'Poterie Traditionnelle',
                'description' => 'Vases et récipients en terre cuite décorés de motifs ancestraux, utilisés dans la vie quotidienne et les cérémonies.',
                'artiste' => 'Potière Traditionnelle',
                'annee_creation' => 2019,
                'dimensions' => '35 × 25 cm',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSly_t773M_UVXio4VqlPdX2QXzSOxbG4roA&s'
            ],
            [
                'titre' => 'Bijoux Touareg en Argent',
                'description' => 'Parure traditionnelle touareg en argent massif, ornée de motifs symboliques et de pierres semi-précieuses.',
                'artiste' => 'Artisan Touareg',
                'annee_creation' => 2021,
                'dimensions' => 'Collier: 45 cm',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-R5fmcdxNgQ9B92Q2tIuREpgXIZ9bRTW9Fw&s'
            ],
            [
                'titre' => 'Textile Kente du Ghana',
                'description' => 'Tissu kente royal tissé à la main avec des fils de soie, aux motifs colorés représentant des proverbes akan.',
                'artiste' => 'Tisserand Ghana',
                'annee_creation' => 2020,
                'dimensions' => '250 × 180 cm',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq7OuFeTTX-LLLjiCUFxtZFY7ajEdYEZER6Q&s'
            ],
            [
                'titre' => 'Sculpture Luba du Congo',
                'description' => 'Figure Luba en bois sculpté représentant la royauté et la sagesse, chef-d\'œuvre de l\'art congolais.',
                'artiste' => 'Sculpteur Luba',
                'annee_creation' => 2018,
                'dimensions' => '50 × 20 × 15 cm',
                'image_url' => 'https://www.franceinfo.fr/pictures/dk6Ox2REILoMQCrJp7acd6Zm9Qc/111x0:1887x999/432x243/filters:format(jpg)/2019/04/11/043_05482890.jpg'
            ],
            [
                'titre' => 'Masque Dogon du Mali',
                'description' => 'Masque dogon utilisé lors des cérémonies du Sigui, représentant la cosmogonie et les connaissances ancestrales.',
                'artiste' => 'Artisan Dogon',
                'annee_creation' => 2019,
                'dimensions' => '42 × 32 cm',
                'image_url' => 'https://afrique.lalibre.be/wp-content/uploads/2024/04/661bf790a0755-Art-Afrique-Met-New-York-787x525.jpg'
            ]
        ];

        foreach ($oeuvres as $oeuvre) {
            GalerieOeuvre::create($oeuvre);
        }

        $this->command->info(count($oeuvres) . ' œuvres d\'art africain créées avec succès.');
    }
}