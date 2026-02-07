<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $fillable = ['route_id', 'gare_id', 'order', 'passage_hour'];

    public function gare() {
        return $this->belongsTo(Gare::class);
    }

    public function route() {
        return $this->belongsTo(Route::class);
    }
}
