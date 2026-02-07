<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Ville;

class Gare extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'ville_id'];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function etapes()
    {
        return $this->hasMany(Etape::class);
    }
}