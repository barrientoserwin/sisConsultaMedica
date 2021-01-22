<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelarConsulta extends Model
{
    protected $table = 'cancelarconsulta';
    protected $fillable = [
        'id',
        'fechaCancelada',
        'justificacion',
        'idConsultaMedica',
        'idAbrogador'
    ];    
    public $timestamps = false;
}
