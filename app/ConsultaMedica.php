<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultaMedica extends Model
{
    protected $table = 'consultamedica';
    protected $fillable = [
        'id',
        'descripcion',
        'fechaConsulta',
        'horaConsulta',
        'estado',
        'tipoConsulta',
        'idMedico',
        'idPaciente',
        'idEspecialidad'
    ];    
    public $timestamps = false;
}
