<?php
// app/Http/Controllers/GalerieOeuvreController.php

namespace App\Http\Controllers;

use App\Models\GalerieOeuvre;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GalerieOeuvreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = GalerieOeuvre::active()->orderBy('created_at', 'desc');

            // Recherche par titre ou artiste
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('titre', 'like', "%{$search}%")
                      ->orWhere('artiste', 'like', "%{$search}%");
                });
            }

            // Pagination
            $perPage = $request->get('per_page', 12);
            $oeuvres = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $oeuvres->items(),
                'pagination' => [
                    'current_page' => $oeuvres->currentPage(),
                    'per_page' => $oeuvres->perPage(),
                    'total' => $oeuvres->total(),
                    'last_page' => $oeuvres->lastPage(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des œuvres.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artiste' => 'nullable|string|max:255',
            'annee_creation' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'dimensions' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->all();

            // Gestion de l'upload d'image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('galerie-oeuvres', 'public');
                $data['image_url'] = $imagePath;
            }

            $oeuvre = GalerieOeuvre::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Œuvre créée avec succès.',
                'data' => $oeuvre
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'œuvre.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $oeuvre = GalerieOeuvre::active()->find($id);

            if (!$oeuvre) {
                return response()->json([
                    'success' => false,
                    'message' => 'Œuvre non trouvée.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $oeuvre
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération de l\'œuvre.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $oeuvre = GalerieOeuvre::find($id);

        if (!$oeuvre) {
            return response()->json([
                'success' => false,
                'message' => 'Œuvre non trouvée.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'artiste' => 'nullable|string|max:255',
            'annee_creation' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'dimensions' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except(['image']);

            // Gestion de l'upload d'image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($oeuvre->image_url && Storage::disk('public')->exists($oeuvre->image_url)) {
                    Storage::disk('public')->delete($oeuvre->image_url);
                }

                $imagePath = $request->file('image')->store('galerie-oeuvres', 'public');
                $data['image_url'] = $imagePath;
            }

            $oeuvre->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Œuvre mise à jour avec succès.',
                'data' => $oeuvre
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de l\'œuvre.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $oeuvre = GalerieOeuvre::find($id);

            if (!$oeuvre) {
                return response()->json([
                    'success' => false,
                    'message' => 'Œuvre non trouvée.'
                ], 404);
            }

            // Supprimer l'image associée si elle existe
            if ($oeuvre->image_url && Storage::disk('public')->exists($oeuvre->image_url)) {
                Storage::disk('public')->delete($oeuvre->image_url);
            }

            $oeuvre->delete();

            return response()->json([
                'success' => true,
                'message' => 'Œuvre supprimée avec succès.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'œuvre.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}