<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concerto extends Model
{
    protected $table = 'Concerto';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
    public $primaryKey = null;

    public function scaletta()
    {
        return $this->belongsTo(Scaletta::class, 'Scaletta', 'ID');
    }

    public function canzone()
    {
        return $this->belongsTo(Canzone::class, 'Canzone', 'Nome');
    }
}