<?php

namespace App\Http\Controllers\Medico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DiasTrabajo;
use Carbon\Carbon;

class DiasTrabajoController extends Controller
{
    private $dias = [
        'Lunes', 
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
        'Domingo'
	];

    public function edit(){
    	$diastrabajo = DiasTrabajo::where('diastrabajo.idMedico', '=' ,\Auth::user()->id)->get();
        
        if (count($diastrabajo) > 0) {
            $diastrabajo->map(function ($workDay) {
                $workDay->turno1Inicio = (new Carbon($workDay->turno1Inicio))->format('g:i A');
                $workDay->turno1Fin = (new Carbon($workDay->turno1Fin))->format('g:i A');
                $workDay->turno2Inicio = (new Carbon($workDay->turno2Inicio))->format('g:i A');
                $workDay->turno2Fin = (new Carbon($workDay->turno2Fin))->format('g:i A');
                return $workDay;
            });
        } else {
            $diastrabajo = collect();
            for ($i=0; $i<7; ++$i)
                $diastrabajo->push(new DiasTrabajo());
        }
    	    	
    	$dias = $this->dias;
    	return view('diastrabajo', compact('diastrabajo', 'dias'));
    }

    public function store(Request $request){
    	$estado = $request->estado ?: [];
    	$turno1Inicio = $request->turno1Inicio;
    	$turno1Fin = $request->turno1Fin;
    	$turno2Inicio = $request->turno2Inicio;
    	$turno2Fin = $request->turno2Fin;

    	$errors = [];
    	for ($i=0; $i<7; ++$i) {
    		if ($turno1Inicio[$i] > $turno1Fin[$i]) {
    			$errors []= 'Las horas del turno mañana son inconsistentes para el día ' . $this->dias[$i] . '.';
    		}
    		if ($turno2Inicio[$i] > $turno2Fin[$i]) {
    			$errors []= 'Las horas del turno tarde son inconsistentes para el día ' . $this->dias[$i] . '.';
    		}

	    	DiasTrabajo::updateOrCreate([
				'codDia' => $i,
				'idMedico' => \Auth::user()->id
			], [		        
				'estado' => in_array($i, $estado),
				'turno1Inicio' => $turno1Inicio[$i],
				'turno1Fin' => $turno1Fin[$i],
				'turno2Inicio' => $turno2Inicio[$i],
				'turno2Fin' => $turno2Fin[$i]
			]);
		}

		if (count($errors) > 0)
	    	return back()->with(compact('errors'));

	    $notificacion = 'Los cambios se han guardado correctamente.';
	    return back()->with(compact('notificacion'));
    }
}
