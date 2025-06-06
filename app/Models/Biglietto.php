<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biglietto extends Model
{
    protected $table = 'Biglietto';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public function posto()
    {
        return $this->belongsTo(Posto::class, 'Tipo', 'ID');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'Evento', 'ID');
    }

    public function ricevuta()
    {
        return $this->belongsTo(Ricevuta::class, 'Ricevuta', 'ID');
    }
}