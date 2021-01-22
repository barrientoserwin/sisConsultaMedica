<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Especialidad;
use App\MedicoEspecialidad;
use DB;

class MedicoController extends Controller
{
    public function index(){
        $medico= User::where('rolUsuario','=','doctor')->get();
        return view('medico.index', compact('medico'));
    }

    public function create(){
        $especialidad = Especialidad::all();
        return view('medico.create', compact('especialidad'));
    }

    public function store(Request $request){
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
                    'password' => bcrypt($request->password)
                ]
            );

            $detalle = $request->especialidad;            
            foreach($detalle as $key=>$value) {
                $obj = new MedicoEspecialidad();
                $obj->idMedico = $user->id; 
                $obj->idEspecialidad = $value;
                $obj->save();
            }            

            DB::commit();

            $notificacion = 'El médico se ha registrado correctamente.';
            return redirect('/medico')->with(compact('notificacion'));
            return[
                'id'=>$user->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function edit($id){
        $medico = User::findOrFail($id);
        $especialidad = Especialidad::all();

        $especialidadIds = MedicoEspecialidad::where('medicoespecialidad.idMedico','=',$medico->id)->pluck('medicoespecialidad.idEspecialidad');
        return view('medico.edit', compact('medico', 'especialidad', 'especialidadIds'));
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'apellidos' => 'nullable|min:10',
                'dni' => 'nullable|min:7|max:8',
                'telefono' => 'nullable|min:6',
                'direccion' => 'nullable|min:5',
            ]);
    
            $user = User::findOrFail($request->id);
    
            $data = $request->only('name', 'email', 'apellidos', 'dni', 'fechaNac','telefono', 'direccion');
            $password = $request->password;
            if ($password)
                $data['password'] = bcrypt($password);
    
            $user->fill($data);
            $user->save();

            $obj = MedicoEspecialidad::where('medicoespecialidad.idMedico','=',$request->id);
            $obj->delete();

            $detalle = $request->especialidad;            
            foreach($detalle as $key=>$value) {
                $obj = new MedicoEspecialidad();
                $obj->idMedico = $user->id; 
                $obj->idEspecialidad = $value;
                $obj->save();
            }            

            DB::commit();

            $notificacion = 'La información del médico se ha actualizado correctamente.';
            return redirect('/medico')->with(compact('notificacion'));
            return[
                'id'=>$user->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function destroy(Request $request){
        $obj = User::findOrFail($request->id); 
        $obj->delete();

        $notificacion = "El médico se ha eliminado correctamente.";
        return redirect('/medico')->with(compact('notificacion'));
    }

}
