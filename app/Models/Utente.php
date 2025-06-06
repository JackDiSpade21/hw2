<?php

namespace App\Models;
use App\Models\Artista;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    protected $table = 'Utente';
    protected $primaryKey = 'Mail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Mail', 'Nome', 'Cognome', 'Psw', 'Tel', 'Nascita', 'Luogo', 'Newsletter'
    ];
}
