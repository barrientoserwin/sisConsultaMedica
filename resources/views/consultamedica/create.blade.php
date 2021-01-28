@extends('layouts.panel')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar nueva cita</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('paciente') }}" class="btn btn-sm btn-default">
            Cancelar y volver
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ url('/consultamedica/store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <input name="descripcion" value="{{ old('descripcion') }}" id="descripcion" type="text" class="form-control" placeholder="Describe brevemente la consulta" required>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="specialty">Especialidad</label>
            <select name="idEspecialidad" id="especialidad" class="form-control" required>
              <option value="">Seleccionar Especialidad</option>
              @foreach ($especialidad as $item)
                <option value="{{ $item->id }}" @if(old('idEspecialidad') == $item->id) selected @endif>{{ $item->nombre }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="email">Médico</label>
            <select name="idMedico" id="medico" class="form-control" required>
              @foreach ($medico as $items)
                <option value="{{ $items->id }}" @if(old('idMedico') == $items->id) selected @endif>{{ $items->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="dni">Fecha</label>
          <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
              </div>
              <input class="form-control datepicker" placeholder="Seleccionar fecha" 
                id="date" name="fechaConsulta" type="text" 
                value="{{ old('fechaConsulta', date('Y-m-d')) }}" 
                data-date-format="yyyy-mm-dd" 
                data-date-start-date="{{ date('Y-m-d') }}" 
                data-date-end-date="+30d">
          </div>
        </div>
        <div class="form-group">
          <label for="address">Hora de atención</label>
          <div id="hours">
            @if ($intervalo)
              @foreach ($intervalo['turno1'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="horaConsulta" value="{{ $interval['inicio'] }}" class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['inicio'] }} - {{ $interval['fin'] }}</label>
                </div>
              @endforeach
              @foreach ($intervalo['turno2'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="horaConsulta" value="{{ $interval['inicio'] }}" class="custom-control-input" id="intervalAfternoon{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['inicio'] }} - {{ $interval['fin'] }}</label>
                </div>
              @endforeach
            @else
              <div class="alert alert-info" role="alert">
                Seleccione un médico y una fecha, para ver sus horas disponibles.
              </div>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="tipoConsulta">Tipo de consulta</label>
          <div class="custom-control custom-radio mb-3">
            <input name="tipoConsulta" class="custom-control-input" id="type1" type="radio"
              @if(old('tipoConsulta', 'Consulta') == 'Consulta') checked @endif value="Consulta">
            <label class="custom-control-label" for="type1">Consulta</label>
          </div>

          <div class="custom-control custom-radio mb-3">
            <input name="tipoConsulta" class="custom-control-input" id="type2" type="radio"
              @if(old('tipoConsulta') == 'Examen') checked @endif value="Examen">
            <label class="custom-control-label" for="type2">Examen</label>
          </div>

          <div class="custom-control custom-radio mb-3">
            <input name="tipoConsulta" class="custom-control-input" id="type3" type="radio"
              @if(old('tipoConsulta') == 'Operación') checked @endif value="Operación">
            <label class="custom-control-label" for="type3">Operación</label>
          </div>

        </div>
        <button type="submit" class="btn btn-primary">
          Guardar
        </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/consultamedica/create.js') }}"></script>
@endsection