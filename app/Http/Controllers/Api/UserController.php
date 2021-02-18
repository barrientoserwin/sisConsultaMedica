<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use App\User;

class UserController extends Controller
{
    public function show(){
    	return auth('api')->user();
    }

	public function buscarPaciente(Request $request){
		$buscar = $request->buscar;
		if($buscar==''){
			$paciente= User::where('rolUsuario','=','paciente')
			->orderBy('users.id','desc')
			->get();
		}else{
			$paciente = User::where('rolUsuario','=','paciente')
			->where('users.name', 'like', '%'.$buscar.'%')			
            ->orderBy('users.id','desc')
			->get();
		}		
        return $paciente;
	}

	public function buscarMedico(Request $request){
		$buscar = $request->buscar;
		if($buscar==''){
			$medico= User::where('rolUsuario','=','doctor')
			->orderBy('users.id','desc')
			->get();
		}else{
			$medico = User::where('rolUsuario','=','doctor')
			->where('users.name', 'like', '%'.$buscar.'%')			
            ->orderBy('users.id','desc')
			->get();
		}		
        return $medico;
	}
}
