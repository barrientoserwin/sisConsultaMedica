<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultaMedica;
use Illuminate\Http\Request;
use App\ConsultaMedica;
use Auth;
use DB;

class ConsultaMedicaController extends Controller
{
    public function index(){        
        $consultamedica = DB::table('consultamedica as cm')
        ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
        ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
        ->select('cm.id','cm.descripcion','cm.fechaReserva','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
        'u1.name as nombreMedico','e.nombre as nombreEspecialidad')
        ->where('cm.idPaciente','=', auth('api')->user()->id)
        ->orderBy('cm.id','desc')
        ->get();
        return $consultamedica;
    }

    public function store(StoreConsultaMedica $request){
    	$idPaciente = auth('api')->user()->id;    	
    	$consultamedica = ConsultaMedica::createForPaciente($request, $idPaciente);    	
    	if ($consultamedica) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }
}
