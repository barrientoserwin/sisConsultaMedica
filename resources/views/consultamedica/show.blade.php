@extends('layouts.panel')

@section('content')
  <div class="card shadow">    
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cita #{{ $consultamedica->id }}</h3>
        </div>
      </div>
    </div>
    <div class="card-body">
      <ul>
        <li><strong>Fecha:</strong> {{ $consultamedica->fechaConsulta }}</li>
        <li><strong>Hora:</strong> {{ \Carbon\Carbon::parse(strtotime($consultamedica->horaConsulta))->format('g:i A') }}</li>
        
        @if ($rolUsuario == 'paciente' || $rolUsuario == 'administrador')
          <li><strong>Médico:</strong> {{ $consultamedica->nombreMedico }}</li>
        @endif
        @if ($rolUsuario == 'doctor' || $rolUsuario == 'administrador')
          <li><strong>Paciente:</strong> {{ $consultamedica->nombrePaciente }}</li>
        @endif

        <li><strong>Especialidad:</strong> {{ $consultamedica->nombreEspecialidad }}</li>
        <li><strong>Tipo:</strong> {{ $consultamedica->tipoConsulta }}</li>
        <li>
          <strong>Estado:</strong> 
          @if ($consultamedica->estado == 'Cancelada')
            <span class="badge badge-danger">Cancelada</span>
          @else
            <span class="badge badge-success">{{ $consultamedica->estado }}</span>
          @endif
        </li>
      </ul>

      @if ($consultamedica->estado == 'Cancelada')
        <div class="alert alert-warning">
          <p>Acerca de la cancelación:</p>
          <ul>
            @if ($consultaCancelada)
              <li>
                <strong>Fecha de cancelación:</strong>
                {{ $consultaCancelada->fechaCancelada }}
              </li>
              <li>
                <strong>¿Quién canceló la cita?:</strong>
                @if (Auth::user()->id == $consultaCancelada->idAbrogador)
                  Tú
                @else
                  {{ $consultaCancelada->nombreAbrogador }} {{ $consultaCancelada->apellidos }}
                @endif
              </li>
              <li>
                <strong>Justificación:</strong>
                {{ $consultaCancelada->justificacion }}
              </li>
            @else
              <li>Esta cita fue cancelada antes de su confirmación.</li>
            @endif
          </ul>
        </div>
      @endif

      <a href="{{ url('/consultamedica') }}" class="btn btn-default">
        Volver
      </a>
    </div>   
  </div>
@endsection
