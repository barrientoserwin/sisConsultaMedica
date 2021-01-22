<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiasTrabajo extends Model
{
    protected $table = 'diastrabajo';
    protected $fillable = [
        'id',
        'codDia',
        'estado',
        'turno1Inicio',
        'turno1Fin',
        'turno2Inicio',
        'turno2Fin',
        'idMedico'
    ];    
    public $timestamps = false;
}
