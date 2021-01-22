<?php namespace App\Interfaces;

use Carbon\Carbon;

interface DiasTrabajoServiceInterface 
{
	public function isAvailableInterval($date, $medicoId, Carbon $start);
	public function getIntervalDisponible($date, $medicoId);
}