<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    /**
     * Liste toutes les visites avec informations utilisateur et œuvre
     */
    public function index()
    {
        return Visite::with(['user', 'oeuvre'])->get();
    }

    /**
     * Ajouter une nouvelle visite
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'oeuvre_id' => 'required|exists:oeuvres,id',
            'visited_at' => 'nullable|date',
        ]);

        $visite = Visite::create([
            'user_id' => $validated['user_id'],
            'oeuvre_id' => $validated['oeuvre_id'],
            'visited_at' => $validated['visited_at'] ?? now(),
        ]);

        return response()->json($visite->load(['user', 'oeuvre']), 201);
    }
public function markAsVisited($oeuvreId)
{
    $userId = auth()->id();
    
    $visite = Visite::create([
        'user_id' => $userId,
        'oeuvre_id' => $oeuvreId,
        'visited_at' => now()
    ]);
    
    return response()->json($visite, 201);
}
    /**
     * Afficher une visite spécifique
     */
    public function show($id)
    {
        return Visite::with(['user', 'oeuvre'])->findOrFail($id);
    }

    /**
     * Mettre à jour une visite
     */
    public function update(Request $request, $id)
    {
        $visite = Visite::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'oeuvre_id' => 'exists:oeuvres,id',
            'visited_at' => 'date|nullable',
        ]);

        $visite->update($validated);

        return response()->json($visite->load(['user', 'oeuvre']), 200);
    }

    /**
     * Supprimer une visite
     */
    public function destroy($id)
    {
        $visite = Visite::findOrFail($id);
        $visite->delete();

        return response()->json(null, 204);
    }
}
