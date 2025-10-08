<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parcours;
use App\Models\Oeuvre;

class OeuvreParcoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les parcours
        $parcoursArts = Parcours::where('title', 'Arts et Traditions Sénégalaises')->first();
        $parcoursTextiles = Parcours::where('title', 'Textiles et Artisanat Africain')->first();
        $parcoursRoyaux = Parcours::where('title', 'Trésors Royaux d\'Afrique')->first();
        $parcoursSacre = Parcours::where('title', 'Art Sacré et Rituels')->first();
        $parcoursEnfants = Parcours::where('title', 'Aventure des Petits Explorateurs')->first();

        // Associer les œuvres aux parcours
        if ($parcoursArts) {
            $oeuvresArts = Oeuvre::whereIn('qr_code', ['MCN001', 'MCN002', 'MCN007'])->pluck('id');
            $parcoursArts->oeuvres()->attach($oeuvresArts);
        }

        if ($parcoursTextiles) {
            $oeuvresTextiles = Oeuvre::whereIn('qr_code', ['MCN003', 'MCN005'])->pluck('id');
            $parcoursTextiles->oeuvres()->attach($oeuvresTextiles);
        }

        if ($parcoursRoyaux) {
            $oeuvresRoyaux = Oeuvre::whereIn('qr_code', ['MCN004', 'MCN008'])->pluck('id');
            $parcoursRoyaux->oeuvres()->attach($oeuvresRoyaux);
        }

        if ($parcoursSacre) {
            $oeuvresSacre = Oeuvre::whereIn('qr_code', ['MCN001', 'MCN002'])->pluck('id');
            $parcoursSacre->oeuvres()->attach($oeuvresSacre);
        }

        if ($parcoursEnfants) {
            $oeuvresEnfants = Oeuvre::whereIn('qr_code', ['MCN001', 'MCN003', 'MCN007'])->pluck('id');
            $parcoursEnfants->oeuvres()->attach($oeuvresEnfants);
        }
    }
}