@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cancelar Consulta Medica</h3>
        </div>
      </div>
    </div>

    <div class="card-body">
      @if (session('notificacion'))
        <div class="alert alert-success" role="alert">
          {{ session('notificacion') }}
        </div>
      @endif

      @if ($rolUsuario == 'paciente')
        <p>
          Estás a punto de cancelar tu cita reservada con el médico 
          {{ $consultamedica->nombreMedico }} 
          (especialidad {{ $consultamedica->nombreEspecialidad }}) 
          para el día {{ $consultamedica->fechaConsulta }}:
        </p>
      @elseif ($rolUsuario == 'doctor')
        <p>
          Estás a punto de cancelar tu Consulta con el paciente 
          {{ $consultamedica->nombrePaciente }} 
          (especialidad {{ $consultamedica->nombreEspecialidad }}) 
          para el día {{ $consultamedica->fechaConsulta }}
          (hora {{ \Carbon\Carbon::parse(strtotime($consultamedica->horaConsulta))->format('g:i A') }}):
        </p>
      @else
        <p>
          Estás a punto de cancelar la Consulta Reservada 
          por el paciente {{ $consultamedica->nombrePaciente }}  
          para ser atendido por el médico {{ $consultamedica->nombreMedico }} 
          (especialidad {{ $consultamedica->nombreEspecialidad }}) 
          el día {{ $consultamedica->fechaConsulta }}
          (hora {{ \Carbon\Carbon::parse(strtotime($consultamedica->horaConsulta))->format('g:i A') }}):
        </p>
      @endif

      <form action="{{ url('/consultamedica/cancelarConfirmada/'.$consultamedica->id) }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="justificacion">Por favor cuéntanos el motivo de la cancelación:</label>
          <textarea required id="justificacion" name="justificacion" rows="3" class="form-control"></textarea>
        </div>
        <button class="btn btn-danger" type="submit">Cancelar Consulta</button>
        <a href="{{ url('/consultamedica') }}" class="btn btn-default">Volver al listado de citas sin cancelar</a>
      </form>
    </div>    

  </div>
@endsection
