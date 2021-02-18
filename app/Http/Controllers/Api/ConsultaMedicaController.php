<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultaMedica;
use Illuminate\Http\Request;
use App\ConsultaMedica;
use App\CancelarConsulta;
use Auth;
use DB;
use Carbon\Carbon;

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

    public function consultaMedicaHRC(Request $request){
        $tipoEstado = $request->tipoEstado;
        if ($tipoEstado == 'historial') { 
            $consultamedica = DB::table('consultamedica as cm')
            ->join('users as u', 'cm.idPaciente', '=', 'u.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaReserva','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->whereIn('cm.estado', ['Atendida', 'Cancelada'])
            ->where('cm.idMedico','=', auth('api')->user()->id)
            ->orderBy('cm.id','desc')
            ->get();

        } elseif ($tipoEstado == 'reservada') {
            $consultamedica = DB::table('consultamedica as cm')
            ->join('users as u', 'cm.idPaciente', '=', 'u.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaReserva','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u.name as nombrePaciente','e.nombre as nombreEspecialidad')    
            ->where('cm.estado', 'Reservada')
            ->where('cm.idMedico','=', auth('api')->user()->id)
            ->orderBy('cm.id','desc')
            ->get();

        } elseif ($tipoEstado == 'confirmada') {
            $consultamedica = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u', 'cm.idPaciente', '=', 'u.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaReserva','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Confirmada')
            ->where('cm.idMedico','=', auth('api')->user()->id)
            ->orderBy('cm.id','desc')
            ->get();
        }    
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

    public function confirmarReserva(Request $request){ 
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Confirmada';
        $consultamedica->save(); 	
    	if ($consultamedica) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }

    public function cancelarReserva(Request $request){ 
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Cancelada';
        $consultamedica->save(); 	
    	if ($consultamedica) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }

    public function confirmarAtendida(Request $request){ 
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Atendida';
        $consultamedica->save(); 	
    	if ($consultamedica) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }

    public function cancelarConfirmada(Request $request){ 
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Cancelada';
        $consultamedica->save(); 	

        $myDate= Carbon::now();
        $obj = new CancelarConsulta();
        $obj->fechaCancelada = $myDate->toDateString(); 
        $obj->justificacion = $request->justificacion; 
        $obj->idConsultaMedica = $request->id; 
        $obj->idAbrogador = auth('api')->user()->id; 
        $obj->save();

    	if ($obj) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }
}
