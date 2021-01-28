<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\DiasTrabajoServiceInterface;
use Carbon\Carbon;

class StoreConsultaMedica extends FormRequest
{
    private $diasTrabajoService;

    public function __construct(DiasTrabajoServiceInterface $diasTrabajoService){
        $this->diasTrabajoService = $diasTrabajoService;
    }

    public function rules(){
        return [
            'descripcion'=>'required',
            'idEspecialidad'=>'exists:especialidad,id',
            'idMedico'=>'exists:users,id',
            'horaConsulta'=>'required'
        ];
    }

    public function messages(){
        return [
            'horaConsulta.required' => 'Por favor seleccione una hora válida para su cita.'
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            $date = $this->input('fechaConsulta');
            $medicoId = $this->input('idMedico');
            $horaConsulta = $this->input('horaConsulta');

            if (!$date || !$medicoId || !$horaConsulta) {
                return;
            }

            $start = new Carbon($horaConsulta);

            if (!$this->diasTrabajoService->isAvailableInterval($date, $medicoId, $start)) {
                $validator->errors()
                    ->add('available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.');
            }
        });
    }
}
