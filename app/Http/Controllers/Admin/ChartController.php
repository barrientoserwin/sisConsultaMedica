<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ConsultaMedica;
use App\User;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function consultamedica(){    	
    	$monthlyCounts = ConsultaMedica::select(
			DB::raw('MONTH(fechaConsulta) as month'), 
			DB::raw('COUNT(1) as count')
		)->groupBy('month')->get()->toArray();

		$counts = array_fill(0, 12, 0);
		foreach ($monthlyCounts as $monthlyCount) {
			$index = $monthlyCount['month']-1;
			$counts[$index] = $monthlyCount['count'];
		}
    	return view('charts.consultamedica', compact('counts'));
    }

    public function medicos(){
    	$now = Carbon::now();
		$end = $now->format('Y-m-d'); 
		$start = $now->subYear()->format('Y-m-d');

    	return view('charts.medico', compact('start', 'end'));
    }

    public function medicoJson(Request $request){    	
    	$start = $request->start;
    	$end = $request->end;

		$doctors = User::select('name')
		->where('users.rolUsuario','=','doctor')
		->withCount([
			'attendedAppointments' => function ($query) use ($start, $end) {
				$query->whereBetween('fechaConsulta',[$start,$end]);
			},
			'cancelledAppointments' => function ($query) use ($start, $end) {
				$query->whereBetween('fechaConsulta',[$start,$end]);
			}
		])
		->orderBy('attended_appointments_count', 'desc')
		->take(5)
		->get();

    	$data = [];
    	$data['categories'] = $doctors->pluck('name');

    	$series = [];
    	// Atendidas
    	$series1['name'] = 'Citas atendidas';
    	$series1['data'] = $doctors->pluck('attended_appointments_count'); 
    	// Canceladas
    	$series2['name'] = 'Citas canceladas';
    	$series2['data'] = $doctors->pluck('cancelled_appointments_count'); 

    	$series[] = $series1;
    	$series[] = $series2;

    	$data['series'] = $series;

    	return $data;
    }
}
