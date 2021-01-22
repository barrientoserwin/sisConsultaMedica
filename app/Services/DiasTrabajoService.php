<?php namespace App\Services;

use App\Interfaces\DiasTrabajoServiceInterface;
use Carbon\Carbon;
use App\DiasTrabajo;
use App\ConsultaMedica;

class DiasTrabajoService implements DiasTrabajoServiceInterface{

    public function isAvailableInterval($date, $medicoId, Carbon $start) {
        $exists = ConsultaMedica::where('idMedico', $medicoId)
            ->where('fechaConsulta', $date)
            ->where('horaConsulta', $start->format('H:i:s'))
            ->exists();

        return !$exists; // available if already none exists
    }

    public function getIntervalDisponible($date, $medicoId){
        $diastrabajo=DiasTrabajo::where('estado',true)
            ->where('codDia', $this->getDayFromDate($date))
            ->where('idMedico', $medicoId)
            ->first([
                'turno1Inicio','turno1Fin',
			    'turno2Inicio','turno2Fin'
            ]);

        if ($diastrabajo) {
            $intervaloTurno1 = $this->getIntervalo($diastrabajo->turno1Inicio, $diastrabajo->turno1Fin,$date, $medicoId);
            $intervaloTurno2 = $this->getIntervalo($diastrabajo->turno2Inicio, $diastrabajo->turno2Fin,$date, $medicoId);
        } else {
            $intervaloTurno1 = [];
            $intervaloTurno2 = [];
        }        

        $data = [];
		$data['turno1']=$intervaloTurno1;
        $data['turno2']=$intervaloTurno2;

        return $data;
    }

	private function getDayFromDate($date){
    	$dateCarbon = new Carbon($date);
    	// dayofWeek
    	// Carbon: 0 (domingo) - 6 (sabado)
    	// diasTrabajo: 0 (lunes) - 6 (domingo)
    	$i = $dateCarbon->dayOfWeek;
    	$day = ($i==0 ? 6 : $i-1);
    	return $day;
	}

	private function getIntervalo($horaInicio, $horaFin, $date, $medicoId) {
		$horaInicio = new Carbon($horaInicio);
    	$horaFin = new Carbon($horaFin);

    	$intervalo = [];
    	while ($horaInicio < $horaFin) {
    		$interval = [];

    		$interval['inicio']  = $horaInicio->format('g:i A');
            $available = $this->isAvailableInterval($date, $medicoId, $horaInicio);
    		$horaInicio->addMinutes(30);
    		$interval['fin']  = $horaInicio->format('g:i A');

            if ($available) {
                $intervalo []= $interval;           
            }    		
    	}
    	return $intervalo;
    }
}