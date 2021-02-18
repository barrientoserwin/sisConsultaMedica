<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConsultaMedica;
use DB;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function daysToMinutes($days){
        $hours = $days * 24;
        return $hours * 60;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        // 1=Domingo, 2=Lunes, 3=Martes, 4=Miercoles, 5=Jueves, 6=Viernes, 7=Sabado        
        
        /*$minutes = $this->daysToMinutes(7);        
        $consultamedicaPorDia = Cache::remember('consultamedica_por_dia', $minutes, function () {
            $results = ConsultaMedica::select([
                    DB::raw('DAYOFWEEK(fechaConsulta) as day'),
                    DB::raw('COUNT(*) as count')
                ])
                ->groupBy(DB::raw('DAYOFWEEK(fechaConsulta)'))
                ->whereIn('estado', ['Confirmada', 'Atendida'])
                ->get(['day', 'count'])
                ->mapWithKeys(function ($item) {
                    return [$item['day'] => $item['count']];
                })->toArray();

            $counts = [];
            for ($i=1; $i<=7; ++$i) {
                if (array_key_exists($i, $results))
                    $counts[] = $results[$i];
                else
                    $counts[] = 0;
            }
            return $counts;
        });*/

        $results = ConsultaMedica::select([
            DB::raw('DAYOFWEEK(fechaConsulta) as day'),
            DB::raw('COUNT(*) as count')
        ])
        ->groupBy(DB::raw('DAYOFWEEK(fechaConsulta)'))
        ->whereIn('estado', ['Confirmada', 'Atendida'])
        ->get(['day', 'count'])
        ->mapWithKeys(function ($item) {
            return [$item['day'] => $item['count']];
        })->toArray();

        $consultamedicaPorDia = [];
        for ($i=1; $i<=7; ++$i) {
            if (array_key_exists($i, $results))
                $consultamedicaPorDia[] = $results[$i];
            else
                $consultamedicaPorDia[] = 0;
        }    

        return view('home', compact('consultamedicaPorDia'));
    }
}
