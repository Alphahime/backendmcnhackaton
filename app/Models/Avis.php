<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'oeuvre_id',
        'commentaire',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class);
    }
}
