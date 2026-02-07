<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = ['program_id', 'departure_id', 'arrival_id', 'tariff', 'distance_in_km']; 

    public function programme() {
        return $this->belongsTo(Programme::class, 'program_id');
    }

    public function departureEtape() {
        return $this->belongsTo(Etape::class, 'departure_id');
    }

    public function arrivalEtape() {
        return $this->belongsTo(Etape::class, 'arrival_id');
    }
}
