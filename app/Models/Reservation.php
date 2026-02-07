<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'segment_id', 'seats_reserved', 'total_price', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function segment() {
        return $this->belongsTo(Segment::class);
    }
}
