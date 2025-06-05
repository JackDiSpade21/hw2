<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
