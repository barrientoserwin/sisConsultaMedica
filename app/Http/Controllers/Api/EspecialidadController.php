<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Especialidad;
use App\User;

class EspecialidadController extends Controller
{
    public function index(){
    	return Especialidad::all(['id', 'nombre']);
    }

    public function medicos(Request $request){
        $idEspecialidad = $request->id;
        $obj =User::join('medicoespecialidad', 'users.id', '=', 'medicoespecialidad.idMedico')
        ->select('users.id','users.name')
        ->where('medicoespecialidad.idEspecialidad','=',$idEspecialidad)
        ->get();
        return $obj;
    }

    public function guardar(Request $request){
        $especialidad = new Especialidad();
        $especialidad->nombre = $request->nombre; 
        $especialidad->descripcion = $request->descripcion; 
        $especialidad->save();

        if ($especialidad) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');
    }
}
