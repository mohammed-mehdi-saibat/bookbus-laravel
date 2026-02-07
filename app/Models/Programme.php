<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = ['route_id', 'bus_id', 'departure_day', 'departure_time', 'arrival_time'];

    public function route() {
        return $this->belongsTo(Route::class);
    }

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function segments() {
        return $this->hasMany(Segment::class, 'program_id');
    }
}
