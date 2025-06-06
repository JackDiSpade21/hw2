<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ricevuta extends Model
{
    protected $table = 'Ricevuta';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'Totale',
        'Quantita',
        'Acquisto',
        'Evento',
        'Utente',
        'Informazioni',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'Evento', 'ID');
    }

    public function utente()
    {
        return $this->belongsTo(Utente::class, 'Utente', 'Mail');
    }

    public function biglietti()
    {
        return $this->hasMany(Biglietto::class, 'Ricevuta', 'ID');
    }
}