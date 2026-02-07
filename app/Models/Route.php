<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['name', 'description'];

    public function etapes() {
        return $this->hasMany(Etape::class)->orderBy('order');
    }
}
