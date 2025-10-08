<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Oeuvre;
use App\Models\Category;

class OeuvreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les catégories
        $artSacre = Category::where('name', 'Art Sacré et Rituel')->first();
        $sculpture = Category::where('name', 'Sculpture Traditionnelle')->first();
        $textiles = Category::where('name', 'Textiles et Tissus')->first();
        $artRoyal = Category::where('name', 'Art Royal et Pouvoir')->first();
        $artContemporain = Category::where('name', 'Art Contemporain Africain')->first();

        $oeuvres = [
            [
                'title' => 'Masque Cérémoniel Traditionnel',
                'description_fr' => 'Masque cérémoniel africain utilisé lors des rituels traditionnels. Sculpté dans du bois précieux et décoré de pigments naturels, il représente les esprits ancestraux et sert de médiateur entre le monde visible et invisible.',
                'description_en' => 'African ceremonial mask used in traditional rituals. Carved from precious wood and decorated with natural pigments, it represents ancestral spirits.',
                'description_wo' => 'Maske sell ci ndoorte yu cosaan. Def ci garab wu rafet, wone rab yu mag, di lien àdduna bu gissee ak bu gisul.',
                'images' => json_encode([
                    'https://media.istockphoto.com/id/538948353/fr/vectoriel/abstrait-art-lafrique-de-safari-africain-la-premier.jpg?s=612x612&w=0&k=20&c=MHaf95FXyStcvSOosK0Ade9n0_uDFJ2HdGj8_FLYDic=',
                    'https://i0.wp.com/day2daygallery.fr/wp-content/uploads/2021/02/lafriquesituation.jpg?fit=920%2C759&ssl=1'
                ]),
                'video_url' => null,
                'audio_url' => 'oeuvres/audio/masque-ceremoniel.mp3',
                'qr_code' => 'MCN001',
                'category_id' => $artSacre->id,
            ],
            [
                'title' => 'Statue Ancestrale en Bois',
                'description_fr' => 'Statue traditionnelle en bois sculpté représentant un ancêtre vénéré. Les traits stylisés et la patine ancienne témoignent du savoir-faire artisanal et de la transmission des traditions à travers les générations.',
                'description_en' => 'Traditional carved wood statue representing a revered ancestor. Stylized features and ancient patina show craftsmanship and tradition transmission.',
                'description_wo' => 'Statue ci garab, féeñee mag bu gëna màgg. Melo ak xeex bi wone liggéey bu baax ak cosaan bu yóbboo.',
                'images' => json_encode([
                    'https://static-images.lpnt.fr/cd-cw809/images/2023/02/16/24137976lpw-24181574-article-jpg_9340692_660x287.jpg',
                    'https://cdn.prod.website-files.com/62582fe8d373fe08089a4cef/625871df4492a53dddbef4dd_Visuel-home-page.jpg'
                ]),
                'video_url' => null,
                'audio_url' => null,
                'qr_code' => 'MCN002',
                'category_id' => $sculpture->id,
            ],
            [
                'title' => 'Art Contemporain Africain',
                'description_fr' => 'Œuvre d\'art contemporain africain mêlant techniques modernes et symboles traditionnels. Cette création reflète la vitalité de la scène artistique africaine actuelle et son dialogue avec le patrimoine culturel.',
                'description_en' => 'African contemporary art work mixing modern techniques and traditional symbols. Reflects the vitality of current African art scene.',
                'description_wo' => 'Liggéey bu bees ci Afrik, wàcce njàngum yu bees ak nataal yu cosaan. Wone dooley ar bu bees bi.',
                'images' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyYP-t6nA_VPQrgOKoABMFt48CLAyDKSyKsA&s',
                    'https://cdn.manomano.com/images/images_products/33034323/P/116472081_1.jpg'
                ]),
                'video_url' => 'oeuvres/videos/art-contemporain.mp4',
                'audio_url' => null,
                'qr_code' => 'MCN003',
                'category_id' => $artContemporain->id,
            ],
            [
                'title' => 'Sculpture sur Bois Traditionnelle',
                'description_fr' => 'Sculpture sur bois réalisée selon les techniques ancestrales africaines. Les motifs géométriques et les formes organiques s\'inspirent de la nature et de la cosmogonie traditionnelle.',
                'description_en' => 'Wood sculpture made using ancestral African techniques. Geometric patterns and organic forms inspired by nature and traditional cosmogony.',
                'description_wo' => 'Xeex ci garab, def ci njàngum yu mag. Nataal yu melokaan ak melo yu ndey.',
                'images' => json_encode([
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIkabb_skq1GXu-dhF7UbqkI27mQRZmuooGg&s',
                    'https://boutique-africaine.com/cdn/shop/articles/origines-de-l-art-africain_1200x1200.jpg?v=1631042893'
                ]),
                'video_url' => 'oeuvres/videos/sculpture-bois.mp4',
                'audio_url' => 'oeuvres/audio/technique-sculpture.mp3',
                'qr_code' => 'MCN004',
                'category_id' => $sculpture->id,
            ],
            [
                'title' => 'Collection d\'Art Tribal',
                'description_fr' => 'Collection d\'objets d\'art tribal africain comprenant des masques, statues et artefacts rituels. Chaque pièce raconte une histoire unique et participe à la richesse du patrimoine culturel africain.',
                'description_en' => 'Collection of African tribal art objects including masks, statues and ritual artifacts. Each piece tells a unique story.',
                'description_wo' => 'Yëf yu bari ci ar tribal: maske, statue, yëfu ndoorte. Kàlluñ féeñee xibaar bu wéy.',
                'images' => json_encode([
                    'https://afrique.lalibre.be/wp-content/uploads/2019/04/art-africain-780x440-690x440.jpg',
                    'https://medias.gazette-drouot.com/prod/medias/mediatheque/174343.jpg'
                ]),
                'video_url' => null,
                'audio_url' => 'oeuvres/audio/patrimoine-africain.mp3',
                'qr_code' => 'MCN005',
                'category_id' => $artSacre->id,
            ],
            [
                'title' => 'Trésors de l\'Art Africain',
                'description_fr' => 'Sélection de trésors de l\'art africain mettant en valeur la diversité des styles et des techniques à travers le continent. Ces œuvres témoignent de la créativité et du génie artistique africain.',
                'description_en' => 'Selection of African art treasures showcasing diversity of styles and techniques across the continent. These works testify to African creativity.',
                'description_wo' => 'Yëf yu rafet ci ar Afrik, wone melo yu bari ak njàngum ci konteer bi. Wone xelam bu xóot.',
                'images' => json_encode([
                    'https://media.lesechos.com/api/v1/images/view/5ee37d8bd286c2493278aedd/1280x720/2249111-tresors-de-lart-africain-a-bruxelles-web-tete-060816692563.jpg',
                    'https://afrique.lalibre.be/wp-content/uploads/2019/04/art-africain-780x440-690x440.jpg'
                ]),
                'video_url' => 'oeuvres/videos/tresors-art.mp4',
                'audio_url' => 'oeuvres/audio/histoire-art.mp3',
                'qr_code' => 'MCN006',
                'category_id' => $artRoyal->id,
            ],
            [
                'title' => 'Masque Dan de Côte d\'Ivoire',
                'description_fr' => 'Masque Dan authentique de Côte d\'Ivoire, réputé pour son équilibre esthétique et sa force spirituelle. Utilisé lors des cérémonies de jugement et de réconciliation communautaire.',
                'description_en' => 'Authentic Dan mask from Ivory Coast, known for its aesthetic balance and spiritual strength. Used during judgment and reconciliation ceremonies.',
                'description_wo' => 'Maske Dan ci Koddiwar, am melo bu rafet ak dooley xel. Jàppkat ci àtte ak jàmm.',
                'images' => json_encode([
                    'https://cdn.prod.website-files.com/62582fe8d373fe08089a4cef/625871df4492a53dddbef4dd_Visuel-home-page.jpg',
                    'https://static-images.lpnt.fr/cd-cw809/images/2023/02/16/24137976lpw-24181574-article-jpg_9340692_660x287.jpg'
                ]),
                'video_url' => null,
                'audio_url' => 'oeuvres/audio/culture-dan.mp3',
                'qr_code' => 'MCN007',
                'category_id' => $artSacre->id,
            ],
            [
                'title' => 'Art Royal Ashanti',
                'description_fr' => 'Objets royaux Ashanti du Ghana, symboles de pouvoir et de prestige. L\'or, les perles et les motifs complexes expriment la richesse et l\'autorité de la cour royale ashanti.',
                'description_en' => 'Ashanti royal objects from Ghana, symbols of power and prestige. Gold, beads and complex patterns express royal court wealth and authority.',
                'description_wo' => 'Yëf yu buur Ashanti ci Ghana, téere bu wóor ci doole ak ngor. Oor, perle ak nataal wone yiw ak sañ-sañ.',
                'images' => json_encode([
                    'https://boutique-africaine.com/cdn/shop/articles/origines-de-l-art-africain_1200x1200.jpg?v=1631042893',
                    'https://media.lesechos.com/api/v1/images/view/5ee37d8bd286c2493278aedd/1280x720/2249111-tresors-de-lart-africain-a-bruxelles-web-tete-060816692563.jpg'
                ]),
                'video_url' => 'oeuvres/videos/royaume-ashanti.mp4',
                'audio_url' => 'oeuvres/audio/symboles-royaux.mp3',
                'qr_code' => 'MCN008',
                'category_id' => $artRoyal->id,
            ],
            [
                'title' => 'Textiles Africains Traditionnels',
                'description_fr' => 'Collection de textiles africains traditionnels aux motifs et couleurs variés. Ces tissus, tissés ou teints à la main, racontent des histoires et expriment des identités culturelles.',
                'description_en' => 'Collection of traditional African textiles with varied patterns and colors. These handwoven or hand-dyed fabrics tell stories and express cultural identities.',
                'description_wo' => 'Tissu yu cosaan ci Afrik, ak nataal yu bari ak mel. Wax xibaar ak fànn yu bari.',
                'images' => json_encode([
                    'https://i0.wp.com/day2daygallery.fr/wp-content/uploads/2021/02/lafriquesituation.jpg?fit=920%2C759&ssl=1',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyYP-t6nA_VPQrgOKoABMFt48CLAyDKSyKsA&s'
                ]),
                'video_url' => 'oeuvres/videos/tissage-traditionnel.mp4',
                'audio_url' => null,
                'qr_code' => 'MCN009',
                'category_id' => $textiles->id,
            ],
            [
                'title' => 'Sculpture Moderne Africaine',
                'description_fr' => 'Sculpture moderne africaine explorant de nouvelles formes et matériaux tout en restant ancrée dans les traditions. Cette œuvre illustre le dynamisme de la création artistique contemporaine en Afrique.',
                'description_en' => 'Modern African sculpture exploring new forms and materials while rooted in traditions. Illustrates dynamism of contemporary artistic creation in Africa.',
                'description_wo' => 'Xeex bu bees ci Afrik, seet melo yu bees waaye yor cosaan. Wone dooley liggéey bu bees bi.',
                'images' => json_encode([
                    'https://cdn.manomano.com/images/images_products/33034323/P/116472081_1.jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIkabb_skq1GXu-dhF7UbqkI27mQRZmuooGg&s'
                ]),
                'video_url' => null,
                'audio_url' => 'oeuvres/audio/artiste-moderne.mp3',
                'qr_code' => 'MCN010',
                'category_id' => $artContemporain->id,
            ]
        ];

        foreach ($oeuvres as $oeuvre) {
            Oeuvre::firstOrCreate(
                ['qr_code' => $oeuvre['qr_code']],
                $oeuvre
            );
        }
    }
}