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
        'fechaReserva',
        'fechaConsulta',
        'horaConsulta',
        'estado',
        'tipoConsulta',
        'idMedico',
        'idPaciente',
        'idEspecialidad'
    ];    
    public $timestamps = false;

    static public function createForPaciente(Request $request, $idPaciente){
        $data = $request->only([
            'descripcion',
            'fechaConsulta',
            'horaConsulta',
            'tipoConsulta',
            'idMedico',
            'idEspecialidad'
        ]);
        $data['estado']='Reservada';
        $myDate= Carbon::now();
        $data['fechaReserva']=$myDate->toDateString();
        $data['idPaciente']=$idPaciente;
        $carbonTime= Carbon::createFromFormat('g:i A',$data['horaConsulta']);
        $data['horaConsulta']= $carbonTime->format('H:i:s');

        return self::create($data);
    } 
}
