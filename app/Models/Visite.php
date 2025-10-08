<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'oeuvre_id',
        'visited_at',
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
