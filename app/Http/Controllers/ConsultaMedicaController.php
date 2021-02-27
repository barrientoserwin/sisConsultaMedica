<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\DiasTrabajoServiceInterface;
use App\Http\Requests\StoreConsultaMedica;
use App\ConsultaMedica;
use App\CancelarConsulta;
use App\Especialidad;
use Carbon\Carbon;
use DB;
use Validator;

class ConsultaMedicaController extends Controller
{
    public function index(){
        $rolUsuario = \Auth::user()->rolUsuario;

        if ($rolUsuario == 'administrador') { 
            $consultaPendiente = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Reservada')
            ->orderBy('cm.id','desc')->paginate(10);

            $consultaConfirmada = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Confirmada')
            ->orderBy('cm.id','desc')->paginate(10);

            $consultaHistorial = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->whereIn('cm.estado', ['Atendida', 'Cancelada'])
            ->orderBy('cm.id','desc')->paginate(10);

        } elseif ($rolUsuario == 'doctor') {
            $consultaPendiente = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')    
            ->where('cm.estado', 'Reservada')
            ->where('cm.idMedico','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);

            $consultaConfirmada = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Confirmada')
            ->where('cm.idMedico','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);

            $consultaHistorial = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->whereIn('cm.estado', ['Atendida', 'Cancelada'])
            ->where('cm.idMedico','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);

        } elseif ($rolUsuario == 'paciente') {
            $consultaPendiente = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Reservada')
            ->where('cm.idPaciente','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);

            $consultaConfirmada = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->where('cm.estado', 'Confirmada')
            ->where('cm.idPaciente','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);

            $consultaHistorial = DB::table('consultamedica as cm')
            ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
            ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
            ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
            ->select('cm.id','cm.descripcion','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
            'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
            ->whereIn('cm.estado', ['Atendida', 'Cancelada'])
            ->where('cm.idPaciente','=', \Auth::user()->id)
            ->orderBy('cm.id','desc')
            ->paginate(10);
        }       

        return view('consultamedica.index',compact('consultaPendiente', 'consultaConfirmada', 'consultaHistorial','rolUsuario'));
    }

    public function create(DiasTrabajoServiceInterface $diasTrabajoService){
    	$especialidad = Especialidad::all();

        $especialidadId = old('idEspecialidad');
        if ($especialidadId) {
            $especialidad = Especialidad::find($especialidadId);
            $medico = $especialidad->users;
        } else {
            $medico = collect();
        }
        
        $date = old('fechaConsulta');
        $medicoId = old('idMedico');
        if ($date && $medicoId) {
            $intervalo = $diasTrabajoService->getIntervalDisponible($date, $medicoId);
        } else {
            $intervalo = null;
        }

        return view('consultamedica.create', compact('especialidad','medico','intervalo'));
    }

    public function store(StoreConsultaMedica $request){
    	$created = ConsultaMedica::createForPaciente($request, \Auth::user()->id);
        if ($created)
    	   $notificacion = 'La cita se ha registrado correctamente!';
        else
           $notificacion = 'Ocurrió un problema al registrar la cita médica.';
        
    	return back()->with(compact('notificacion'));
    }

    public function cancelarReservada(Request $request){
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Cancelada';
        $consultamedica->save();

        $notificacion = 'La consulta medica se ha cancelado correctamente.';
	    return back()->with(compact('notificacion'));
    }

    public function cancelarConfir(Request $request){
        $consultamedica = DB::table('consultamedica as cm')
        ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
        ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
        ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
        ->select('cm.id','cm.fechaConsulta','cm.horaConsulta','cm.estado','u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
        ->where('cm.id','=',$request->id)->first();

        if ($consultamedica->estado == 'Confirmada') {
            $rolUsuario = \Auth::user()->rolUsuario;
            return view('consultamedica.cancel', compact('consultamedica', 'rolUsuario'));
        }

        return redirect('/consultamedica');
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
        $obj->idAbrogador = \Auth::user()->id; 
        $obj->save();

        $notificacion = 'La consulta medica se ha cancelado correctamente.';
        return redirect('/consultamedica')->with(compact('notificacion'));
    }

    public function consultaAtendida(Request $request){
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Atendida';
        $consultamedica->save();

        $notificacion = 'La consulta medica se ha marcado como atendida.';
	    return back()->with(compact('notificacion'));
    }

    public function verConsulta(Request $request){
        $consultamedica = DB::table('consultamedica as cm')
        ->join('users as u1', 'cm.idMedico', '=', 'u1.id')
        ->join('users as u2', 'cm.idPaciente', '=', 'u2.id')
        ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
        ->select('cm.id','cm.fechaConsulta','cm.horaConsulta','cm.estado','cm.tipoConsulta',
        'u1.name as nombreMedico','u2.name as nombrePaciente','e.nombre as nombreEspecialidad')
        ->where('cm.id','=',$request->id)->first();

        $consultaCancelada = DB::table('cancelarconsulta as cc')
        ->join('users as u', 'cc.idAbrogador', '=', 'u.id')
        ->join('consultamedica as cm', 'cc.idConsultaMedica', '=', 'cm.id')
        ->select('cc.id','cc.fechaCancelada','cc.justificacion','u.name as nombreAbrogador','u.apellidos','cc.idAbrogador')
        ->where('cm.id','=',$request->id)->first();

        $rolUsuario = \Auth::user()->rolUsuario;
        return view('consultamedica.show', compact('consultamedica', 'rolUsuario','consultaCancelada'));
    }

    public function confirmarConsulta(Request $request){
        $consultamedica = ConsultaMedica::findOrFail($request->id); 
        $consultamedica->estado = 'Confirmada';
        $consultamedica->save();

        $notificacion = 'La consulta medica se ha confirmado correctamente.';
        return redirect('/consultamedica')->with(compact('notificacion'));
    }

    public function misPacientes(){
        $idMedico = \Auth::user()->id;

        $paciente = DB::table('consultamedica as cm')
        ->join('users as u', 'cm.idPaciente', '=', 'u.id')
        ->join('especialidad as e', 'cm.idEspecialidad', '=', 'e.id')
        ->select('u.name','u.apellidos','cm.fechaReserva','cm.fechaConsulta','cm.horaConsulta','cm.tipoConsulta','cm.estado',
        'e.nombre as nombreEspecialidad')
        ->where('cm.idMedico','=',$idMedico)
        ->orderBy('cm.fechaConsulta','desc')
        ->get();

        return view('medico.mispacientes', compact('paciente'));
    }
}
