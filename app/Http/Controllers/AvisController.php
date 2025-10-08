<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    /**
     * Liste tous les avis avec infos utilisateur et œuvre
     */
    public function index()
    {
        return Avis::with(['user', 'oeuvre'])->get();
    }

    /**
     * Ajouter un nouvel avis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'oeuvre_id' => 'required|exists:oeuvres,id',
            'commentaire' => 'nullable|string',
            'note' => 'required|integer|min:0|max:5',
        ]);

        $avis = Avis::create($validated);

        return response()->json($avis->load(['user', 'oeuvre']), 201);
    }

    /**
     * Afficher un avis spécifique
     */
    public function show($id)
    {
        return Avis::with(['user', 'oeuvre'])->findOrFail($id);
    }

    /**
     * Mettre à jour un avis
     */
    public function update(Request $request, $id)
    {
        $avis = Avis::findOrFail($id);

        $validated = $request->validate([
            'commentaire' => 'nullable|string',
            'note' => 'integer|min:0|max:5',
        ]);

        $avis->update($validated);

        return response()->json($avis->load(['user', 'oeuvre']), 200);
    }
public function getByOeuvre($oeuvreId)
{
    $avis = Avis::where('oeuvre_id', $oeuvreId)
                ->with('user')
                ->get();
    
    return response()->json($avis);
}
    /**
     * Supprimer un avis
     */
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();

        return response()->json(null, 204);
    }
}
