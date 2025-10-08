<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OeuvreController;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalerieOeuvreController;
// Auth routes
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Routes publiques (sans authentification)
Route::get('oeuvres', [OeuvreController::class, 'index']);
Route::get('oeuvres/{id}', [OeuvreController::class, 'show']);
Route::get('oeuvres/qr/{qr_code}', [OeuvreController::class, 'showByQrCode'])->name('oeuvre.qr.show');
Route::get('parcours', [ParcoursController::class, 'index']);
Route::get('parcours/{id}', [ParcoursController::class, 'show']);
Route::get('oeuvres/{id}/avis', [AvisController::class, 'getByOeuvre']);
Route::post('oeuvres', [OeuvreController::class, 'store']); // ← LAISSER POUR TEST

// Routes publiques pour les catégories
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('categories/{category}/oeuvres', [CategoryController::class, 'getOeuvresByCategory']);

// Nouvelles routes publiques pour les parcours (LECTURE SEULEMENT)
Route::get('parcours/featured', [ParcoursController::class, 'featured']);
Route::get('parcours/difficulty/{difficulty}', [ParcoursController::class, 'byDifficulty']);

// Routes pour utilisateurs authentifiés
Route::group(['middleware' => 'auth:api'], function () {
    // Profil et déconnexion
    Route::get('me', [UserController::class, 'me']);
    Route::post('logout', [UserController::class, 'logout']);

    // Routes pour les avis spécifiques aux oeuvres
    Route::post('oeuvres/{id}/avis', [AvisController::class, 'store']);
    
    // Routes pour les visites
    Route::post('oeuvres/{id}/visite', [VisiteController::class, 'markAsVisited']);
    Route::get('visites', [VisiteController::class, 'index']);

    // Routes API Resource standard
    Route::apiResource('avis', AvisController::class)->only(['index', 'show']);
    Route::apiResource('visites', VisiteController::class)->only(['index', 'show']);
});

// Routes réservées aux admins
Route::group(['middleware' => ['auth:api', 'admin']], function () {
    // Gestion complète des oeuvres, parcours et médias
    Route::apiResource('oeuvres', OeuvreController::class)->except(['index', 'show']);
    Route::get('oeuvres/{id}/download-qr', [OeuvreController::class, 'downloadQrCode']);
    Route::apiResource('parcours', ParcoursController::class)->except(['index', 'show']); // ← ICI SE TROUVE POST /parcours
    Route::apiResource('medias', MediaController::class)->except(['index', 'show']);

    // Gestion complète des avis et visites
    Route::apiResource('avis', AvisController::class)->except(['index', 'show', 'store']);
    Route::apiResource('visites', VisiteController::class)->except(['index', 'show', 'store']);
});


// Routes pour les œuvres de galerie
Route::prefix('galerie-oeuvres')->group(function () {
    Route::get('/', [GalerieOeuvreController::class, 'index']);
    Route::get('/{id}', [GalerieOeuvreController::class, 'show']);
    
    // Routes protégées
    // Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', [GalerieOeuvreController::class, 'store']);
        Route::put('/{id}', [GalerieOeuvreController::class, 'update']);
        Route::delete('/{id}', [GalerieOeuvreController::class, 'destroy']);
    // });
});