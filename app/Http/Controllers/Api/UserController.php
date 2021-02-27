<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use App\User;
use App\MedicoEspecialidad;
use DB;

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

	public function storePaciente(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'apellidos' => 'nullable|min:5',
            'dni' => 'nullable|min:7|max:8',
            'telefono' => 'nullable|min:6',
            'direccion' => 'nullable|min:5',
        ]);

        $user = User::create(
            $request->only('name', 'email', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion')
            + [
                'rolUsuario' => 'paciente',
                'password' => bcrypt($request->input('dni'))
            ]
        );

		if ($user) 
    		$success = true;
    	else 
    		$success = false;
        
        return compact('success');
    }

	public function destroy(Request $request){
        $user = User::findOrFail($request->id); 
        $user->delete();

        if ($user) 
    		$success = true;
    	else 
    		$success = false;
        
        return compact('success');
    }

	public function updatePaciente(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'apellidos' => 'nullable|min:5',
            'dni' => 'nullable|min:7|max:8',
            'telefono' => 'nullable|min:6',
            'direccion' => 'nullable|min:5',
        ]);

        $user = User::findOrFail($request->id);
        $data = $request->only('name', 'email', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion');
        $user->fill($data);
        $user->save();

        if ($user) 
    		$success = true;
    	else 
    		$success = false;
        
        return compact('success');
    }

    public function storeMedico(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'apellidos' => 'nullable|min:5',
                'dni' => 'nullable|min:7|max:8',
                'telefono' => 'nullable|min:6',
                'direccion' => 'nullable|min:5',
            ]);
    
            $user = User::create(
                $request->only('name', 'email', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion')
                + [
                    'rolUsuario' => 'doctor',
                    'password' => bcrypt($request->input('dni'))
                ]
            );

            $obj = new MedicoEspecialidad();
            $obj->idMedico = $user->id; 
            $obj->idEspecialidad = $request->idEspecialidad;
            $obj->save();           

            DB::commit();

            if ($obj) 
                $success = true;
            else 
                $success = false;
            
            return compact('success');

            return[
                'id'=>$user->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }

    }

    public function updateMedico(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'apellidos' => 'nullable|min:5',
            'dni' => 'nullable|min:7|max:8',
            'telefono' => 'nullable|min:6',
            'direccion' => 'nullable|min:5',
        ]);

        $user = User::findOrFail($request->id);
        $data = $request->only('name', 'email', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion');
        $user->fill($data);
        $user->save();

        if ($user) 
    		$success = true;
    	else 
    		$success = false;
        
        return compact('success');
    }

    public function destroyMedico(Request $request){
        $idMedico = $request->id;
        $user_especialidad = MedicoEspecialidad::where('idMedico','=',$idMedico);
        $user_especialidad->delete();

        $user = User::findOrFail($request->id); 
        $user->delete();

        if ($user) 
    		$success = true;
    	else 
    		$success = false;
        
        return compact('success');
    }
}
