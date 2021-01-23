<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PacienteController extends Controller
{
    public function index(){
        $paciente= User::where('rolUsuario','=','paciente')->paginate(5);
        return view('paciente.index', compact('paciente'));
    }

    public function create(){
        return view('paciente.create');
    }

    public function store(Request $request){
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
                'password' => bcrypt($request->input('password'))
            ]
        );
        
        $notificacion = 'El paciente se ha registrado correctamente.';
        return redirect('/paciente')->with(compact('notificacion'));
    }

    public function edit($id){ 
        $paciente = User::findOrFail($id);
        return view('paciente.edit', compact('paciente'));
    }

    public function update(Request $request){
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
        $password = $request->password;
        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notificacion = 'La información del paciente se ha actualizado correctamente.';
        return redirect('/paciente')->with(compact('notificacion'));
    }

    public function destroy(Request $request){
        $obj = User::findOrFail($request->id); 
        $obj->delete();

        $notificacion = "El paciente se ha eliminado correctamente.";
        return redirect('/paciente')->with(compact('notificacion'));
    }
}
