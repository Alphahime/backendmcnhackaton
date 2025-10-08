<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Liste de tous les médias
     */
    public function index()
    {
        return Media::with('oeuvre')->get();
    }

    /**
     * Ajouter un nouveau média
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'oeuvre_id' => 'required|exists:oeuvres,id',
            'type' => 'required|in:image,audio,video,ar_model',
            'url' => 'required|string',
        ]);

        $media = Media::create($validated);

        return response()->json($media, 201);
    }

    /**
     * Afficher un média spécifique
     */
    public function show($id)
    {
        return Media::with('oeuvre')->findOrFail($id);
    }

    /**
     * Mettre à jour un média
     */
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $validated = $request->validate([
            'type' => 'in:image,audio,video,ar_model',
            'url' => 'string',
        ]);

        $media->update($validated);

        return response()->json($media, 200);
    }

    /**
     * Supprimer un média
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json(null, 204);
    }
}
