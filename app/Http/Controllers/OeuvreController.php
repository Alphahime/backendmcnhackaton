<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OeuvreController extends Controller
{
    /**
     * Liste toutes les œuvres avec médias et avis
     */
    public function index()
    {
        return Oeuvre::with(['medias', 'avis', 'category'])->get();
    }

    /**
     * Ajouter une nouvelle œuvre avec QR code généré automatiquement
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description_fr' => 'required|string',
        'description_en' => 'nullable|string',
        'description_wo' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
        'audio' => 'nullable|mimes:mp3,wav,ogg|max:5120',
        'category_id' => 'nullable|exists:categories,id'
    ]);

    // Génération d’un QR code unique (chaîne simple)
    $qrCode = 'ART' . date('Ymd') . '_' . strtoupper(substr(uniqid(), -6));

    // Upload de l'image (si présente)
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('oeuvres/images', 'public');
        $validated['images'] = json_encode([$path]);
    }

    // Upload de la vidéo
    if ($request->hasFile('video')) {
        $validated['video_url'] = $request->file('video')->store('oeuvres/videos', 'public');
    }

    // Upload de l’audio
    if ($request->hasFile('audio')) {
        $validated['audio_url'] = $request->file('audio')->store('oeuvres/audio', 'public');
    }

    // Génération et sauvegarde du QR code en image
    $qrImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
        ->size(300)
        ->generate(url('/oeuvres/qr/' . $qrCode));

    $qrPath = 'qrcodes/' . $qrCode . '.png';
    \Illuminate\Support\Facades\Storage::disk('public')->put($qrPath, $qrImage);

    // Ajout du code QR
    $validated['qr_code'] = $qrCode;

    // Création de l’œuvre
    $oeuvre = \App\Models\Oeuvre::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Œuvre créée avec succès',
        'data' => $oeuvre->load(['category']),
    ], 201);
}

    /**
     * Génère un QR code unique
     */
    private function generateUniqueQrCode()
    {
        do {
            $qrCode = 'ART' . date('Ymd') . '_' . strtoupper(substr(uniqid(), -6));
        } while (Oeuvre::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }

    /**
     * Génère l'image du QR code
     */
    private function generateQrCodeImage($qrCode, $title)
    {
        $url = route('oeuvre.qr.show', ['qr_code' => $qrCode]);
        
        // Générer le QR code
        $qrImage = QrCode::format('png')
            ->size(300)
            ->generate($url);
        
        // Sauvegarder l'image
        $filename = 'qrcodes/' . $qrCode . '.png';
        Storage::disk('public')->put($filename, $qrImage);
        
        return $filename;
    }

    /**
     * Affiche une œuvre spécifique avec médias et avis
     */
    public function show($id)
    {
        $oeuvre = Oeuvre::with(['medias', 'avis', 'category'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $oeuvre
        ]);
    }

    /**
     * Affiche une œuvre via son QR code (pour le scan)
     */
    public function showByQrCode($qr_code)
    {
        $oeuvre = Oeuvre::with(['medias', 'avis', 'category'])
            ->where('qr_code', $qr_code)
            ->firstOrFail();

        // Retourner une vue HTML pour l'affichage mobile
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $oeuvre
            ]);
        }

        // Retourner une vue HTML pour le scan
        return view('oeuvres.qr-show', compact('oeuvre'));
    }

    /**
     * Mettre à jour une œuvre
     */
    public function update(Request $request, $id)
    {
        $oeuvre = Oeuvre::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description_fr' => 'sometimes|string',
            'description_en' => 'nullable|string',
            'description_wo' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'audio' => 'nullable|mimes:mp3,wav,ogg|max:5120',
            'category_id' => 'nullable|exists:categories,id'
            // Ne pas permettre la modification du QR code
        ]);

        // Gestion de l'upload de la nouvelle image - EN JSON
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($oeuvre->images) {
                $oldImages = json_decode($oeuvre->images, true);
                if (is_array($oldImages)) {
                    foreach ($oldImages as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }
            }
            $imagePath = $request->file('image')->store('oeuvres/images', 'public');
            $validated['images'] = json_encode([$imagePath]);
        }

        // Gestion de l'upload de la nouvelle vidéo
        if ($request->hasFile('video')) {
            // Supprimer l'ancienne vidéo si elle existe
            if ($oeuvre->video_url && Storage::disk('public')->exists($oeuvre->video_url)) {
                Storage::disk('public')->delete($oeuvre->video_url);
            }
            $validated['video_url'] = $request->file('video')->store('oeuvres/videos', 'public');
        }

        // Gestion de l'upload du nouvel audio
        if ($request->hasFile('audio')) {
            // Supprimer l'ancien audio si il existe
            if ($oeuvre->audio_url && Storage::disk('public')->exists($oeuvre->audio_url)) {
                Storage::disk('public')->delete($oeuvre->audio_url);
            }
            $validated['audio_url'] = $request->file('audio')->store('oeuvres/audio', 'public');
        }

        $oeuvre->update($validated);


        return response()->json([
            'success' => true,
            'message' => 'Œuvre mise à jour avec succès',
            'data' => $oeuvre->fresh(['medias', 'category'])
        ]);
    }

    /**
     * Supprimer une œuvre
     */
    public function destroy($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);

        // Supprimer les fichiers associés
        if ($oeuvre->images) {
            $oldImages = json_decode($oeuvre->images, true);
            if (is_array($oldImages)) {
                foreach ($oldImages as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
        }
        if ($oeuvre->video_url && Storage::disk('public')->exists($oeuvre->video_url)) {
            Storage::disk('public')->delete($oeuvre->video_url);
        }
        if ($oeuvre->audio_url && Storage::disk('public')->exists($oeuvre->audio_url)) {
            Storage::disk('public')->delete($oeuvre->audio_url);
        }

        // Supprimer le QR code
        $qrCodePath = 'qrcodes/' . $oeuvre->qr_code . '.png';
        if (Storage::disk('public')->exists($qrCodePath)) {
            Storage::disk('public')->delete($qrCodePath);
        }

        $oeuvre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Œuvre supprimée avec succès'
        ]);
    }

    /**
     * Télécharger le QR code d'une œuvre
     */
    public function downloadQrCode($id)
    {
        $oeuvre = Oeuvre::findOrFail($id);
        $qrCodePath = 'qrcodes/' . $oeuvre->qr_code . '.png';

        if (!Storage::disk('public')->exists($qrCodePath)) {
            // Régénérer le QR code s'il n'existe pas
            $this->generateQrCodeImage($oeuvre->qr_code, $oeuvre->title);
        }

        return Storage::disk('public')->download($qrCodePath, 'qr-code-' . $oeuvre->title . '.png');
    }

    /**
     * Télécharger un fichier média
     */
    public function downloadMedia($id, $type)
    {
        $oeuvre = Oeuvre::findOrFail($id);
        
        $filePath = null;
        $fileName = null;

        switch ($type) {
            case 'image':
                // Prendre la première image
                if ($oeuvre->images) {
                    $images = json_decode($oeuvre->images, true);
                    $filePath = $images[0] ?? null;
                    $fileName = 'image-' . $oeuvre->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                }
                break;
            case 'video':
                $filePath = $oeuvre->video_url;
                $fileName = 'video-' . $oeuvre->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            case 'audio':
                $filePath = $oeuvre->audio_url;
                $fileName = 'audio-' . $oeuvre->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            default:
                return response()->json(['error' => 'Type de média non supporté'], 400);
        }

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            return response()->json(['error' => 'Fichier non trouvé'], 404);
        }

        return Storage::disk('public')->download($filePath, $fileName);
    }
}