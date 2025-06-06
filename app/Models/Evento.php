<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artista;

class Evento extends Model
{
    protected $table = 'Evento';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = [];

    public function artista()
    {
        return $this->hasOne(Artista::class, 'ID');
    }
}
