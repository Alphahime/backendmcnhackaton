<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Parcours extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'difficulty',
        'estimated_duration',
        'target_audience',
        'is_featured',
        'order',
        'themes'
    ];

    protected $casts = [
        'themes' => 'array',
        'is_featured' => 'boolean',
        'estimated_duration' => 'integer',
        'order' => 'integer'
    ];

    protected $appends = ['image_full_url'];

    public function getImageFullUrlAttribute()
    {
        // Si c'est une URL complète (http/https), la retourner directement
        if ($this->image_url && (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://'))) {
            return $this->image_url;
        }
        
        // Si c'est un chemin local, utiliser Storage
        if ($this->image_url && Storage::disk('public')->exists($this->image_url)) {
            return Storage::disk('public')->url($this->image_url);
        }
        
        // Image par défaut
        return null;
    }

    public function getFormattedDurationAttribute()
    {
        if (!$this->estimated_duration) {
            return null;
        }

        $hours = floor($this->estimated_duration / 60);
        $minutes = $this->estimated_duration % 60;

        if ($hours > 0) {
            return $hours . 'h' . ($minutes > 0 ? $minutes . 'min' : '');
        }

        return $minutes . 'min';
    }

    // Scope pour trier par ordre
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('title');
    }

    // Scope pour les parcours en vedette
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope par difficulté
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    public function oeuvres()
    {
        return $this->belongsToMany(Oeuvre::class, 'oeuvre_parcours')
                   ->withPivot('order')
                   ->orderBy('oeuvre_parcours.order');
    }
}