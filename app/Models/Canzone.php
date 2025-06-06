<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canzone extends Model
{
    protected $table = 'Canzone';
    protected $primaryKey = 'Nome';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function scalette()
    {
        return $this->belongsToMany(Scaletta::class, 'Concerto', 'Canzone', 'Scaletta');
    }
}