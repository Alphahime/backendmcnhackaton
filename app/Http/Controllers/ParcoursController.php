<?php

namespace App\Http\Controllers;

use App\Models\Parcours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParcoursController extends Controller
{
    /**
     * Liste tous les parcours avec leurs œuvres
     */
 public function index()
{
    try {
        // Test 1: Parcours sans relations
        $parcours = Parcours::ordered()->get();
        
        return response()->json([
            'success' => true,
            'data' => $parcours,
            'count' => $parcours->count()
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
}

    /**
     * Ajouter un nouveau parcours
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'difficulty' => 'nullable|in:facile,moyen,difficile',
            'estimated_duration' => 'nullable|integer|min:1',
            'target_audience' => 'nullable|in:enfants,scolaires,adultes,experts',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'themes' => 'nullable|array',
            'themes.*' => 'string|max:255'
        ]);

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('parcours/images', 'public');
        }

        // Conversion des thèmes en JSON
        if (isset($validated['themes'])) {
            $validated['themes'] = json_encode($validated['themes']);
        }

        $parcours = Parcours::create($validated);

        // Ajouter des œuvres si elles sont envoyées
        if ($request->has('oeuvre_ids')) {
            $parcours->oeuvres()->sync($request->input('oeuvre_ids'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Parcours créé avec succès',
            'data' => $parcours->load(['oeuvres', 'oeuvres.category'])
        ], 201);
    }

    /**
     * Affiche un parcours spécifique avec ses œuvres
     */
/**
 * Affiche un parcours spécifique avec ses œuvres
 */
public function show($id)
{
    try {
        $parcours = Parcours::with([
            'oeuvres' => function($query) {
                $query->select(
                    'oeuvres.id', // Spécifier explicitement la table
                    'oeuvres.title', 
                    'oeuvres.description_fr', 
                    'oeuvres.image_url', 
                    'oeuvres.category_id', 
                    'oeuvres.qr_code'
                );
            },
            'oeuvres.category' => function($query) {
                $query->select('id', 'name', 'slug');
            }
        ])->find($id);

        if (!$parcours) {
            return response()->json([
                'success' => false,
                'message' => 'Parcours non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $parcours
        ]);

    } catch (\Exception $e) {
        \Log::error('Erreur ParcoursController@show: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors du chargement du parcours',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

    /**
     * Mettre à jour un parcours
     */
    public function update(Request $request, $id)
    {
        $parcours = Parcours::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'difficulty' => 'nullable|in:facile,moyen,difficile',
            'estimated_duration' => 'nullable|integer|min:1',
            'target_audience' => 'nullable|in:enfants,scolaires,adultes,experts',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'themes' => 'nullable|array',
            'themes.*' => 'string|max:255'
        ]);

        // Gestion de l'upload de la nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($parcours->image_url && Storage::disk('public')->exists($parcours->image_url)) {
                Storage::disk('public')->delete($parcours->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('parcours/images', 'public');
        }

        // Conversion des thèmes en JSON
        if (isset($validated['themes'])) {
            $validated['themes'] = json_encode($validated['themes']);
        }

        $parcours->update($validated);

        // Mettre à jour les œuvres liées si fourni
        if ($request->has('oeuvre_ids')) {
            $parcours->oeuvres()->sync($request->input('oeuvre_ids'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Parcours mis à jour avec succès',
            'data' => $parcours->fresh(['oeuvres', 'oeuvres.category'])
        ]);
    }

    /**
     * Supprimer un parcours
     */
    public function destroy($id)
    {
        $parcours = Parcours::findOrFail($id);

        // Supprimer l'image associée si elle existe
        if ($parcours->image_url && Storage::disk('public')->exists($parcours->image_url)) {
            Storage::disk('public')->delete($parcours->image_url);
        }

        $parcours->delete();

        return response()->json([
            'success' => true,
            'message' => 'Parcours supprimé avec succès'
        ]);
    }

    /**
     * Télécharger l'image du parcours
     */
    public function downloadImage($id)
    {
        $parcours = Parcours::findOrFail($id);

        if (!$parcours->image_url || !Storage::disk('public')->exists($parcours->image_url)) {
            return response()->json(['error' => 'Image non trouvée'], 404);
        }

        $fileName = 'parcours-' . $parcours->title . '.' . pathinfo($parcours->image_url, PATHINFO_EXTENSION);
        
        return Storage::disk('public')->download($parcours->image_url, $fileName);
    }

    /**
     * Récupérer les parcours mis en avant
     */
    public function featured()
    {
        $parcours = Parcours::with(['oeuvres', 'oeuvres.category'])
                          ->where('is_featured', true)
                          ->ordered()
                          ->get();

        return response()->json([
            'success' => true,
            'data' => $parcours
        ]);
    }

    /**
     * Filtrer les parcours par difficulté
     */
    public function byDifficulty($difficulty)
    {
        $parcours = Parcours::with(['oeuvres', 'oeuvres.category'])
                          ->where('difficulty', $difficulty)
                          ->ordered()
                          ->get();

        return response()->json([
            'success' => true,
            'data' => $parcours
        ]);
    }
}