<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;

class Artista extends Model
{
    protected $table = 'Artista';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = [];

    public function eventi()
    {
        return $this->hasMany(Evento::class, 'Artista', 'ID');
    }

    public function scaletta()
    {
        return $this->hasMany(Scaletta::class, 'Artista', 'ID');
    }
}
