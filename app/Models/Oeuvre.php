<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Oeuvre extends Model
{
    use HasFactory;

    protected $guarded = []; // Tous les champs sont mass assignable

    protected $appends = ['image_full_url', 'video_full_url', 'audio_full_url'];

    // CORRECTION : Utiliser le champ 'images' qui existe vraiment
    public function getImageFullUrlAttribute()
    {
        if ($this->images) {
            $images = json_decode($this->images, true);
            return $images && count($images) > 0 ? Storage::disk('public')->url($images[0]) : null;
        }
        return null;
    }

    public function getVideoFullUrlAttribute()
    {
        return $this->video_url ? Storage::disk('public')->url($this->video_url) : null;
    }

    public function getAudioFullUrlAttribute()
    {
        return $this->audio_url ? Storage::disk('public')->url($this->audio_url) : null;
    }

    // Relations existantes...
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function parcours()
    {
        return $this->belongsToMany(Parcours::class, 'oeuvre_parcours');
    }
}