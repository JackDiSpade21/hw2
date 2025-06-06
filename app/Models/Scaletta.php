<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scaletta extends Model
{
    protected $table = 'Scaletta';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public function artista()
    {
        return $this->belongsTo(Artista::class, 'Artista', 'ID');
    }

    public function canzoni()
    {
        return $this->belongsToMany(Canzone::class, 'Concerto', 'Scaletta', 'Canzone');
    }
}