<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $table = 'medias';
    protected $fillable = [
        'oeuvre_id',
        'type',
        'url',
    ];

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class);
    }
}
