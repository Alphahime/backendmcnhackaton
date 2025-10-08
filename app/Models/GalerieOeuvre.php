<?php
// app/Models/GalerieOeuvre.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalerieOeuvre extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galerie_oeuvres';

    protected $fillable = [
        'titre',
        'description',
        'artiste',
        'annee_creation',
        'dimensions',
        'image_url'
    ];

    protected $casts = [
        'annee_creation' => 'integer'
    ];

    /**
     * Scope pour les œuvres actives
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Accessor pour l'URL complète de l'image
     */
    public function getImageFullUrlAttribute()
    {
        if ($this->image_url) {
            return asset('storage/' . $this->image_url);
        }
        return null;
    }
}