<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DiasTrabajoServiceInterface;
use App\DiasTrabajo;
use Carbon\Carbon;

class DiasTrabajoController extends Controller
{
    public function hours(Request $request, DiasTrabajoServiceInterface $diasTrabajoService){
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'idMedico' => 'required|exists:users,id'
    	];
    	$request->validate($rules);

    	$date = $request->date;
		$medicoId = $request->idMedico;
		return $diasTrabajoService->getIntervalDisponible($date, $medicoId);  		
	}
}
