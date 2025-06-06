<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    protected $table = 'Posto';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'Evento', 'ID');
    }

    public function biglietti()
    {
        return $this->hasMany(Biglietto::class, 'Tipo', 'ID');
    }
}
