@extends('layouts.panel')

@section('content')
<form action="{{ url('/diastrabajo/store') }}" method="post">
  @csrf  
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Gestionar horario</h3>
        </div>
        <div class="col text-right">
          <button type="submit" class="btn btn-sm btn-success">
            Guardar cambios
          </button>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if (session('notificacion'))
        <div class="alert alert-success" role="alert">
          {{ session('notificacion') }}
        </div>
      @endif

      @if (session('errors'))
        <div class="alert alert-danger" role="alert">
          Los cambios se han guardado pero tener en cuenta que:
          <ul>
          @foreach (session('errors') as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
        </div>
      @endif      
    </div>    
    <div class="table-responsive">
       <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Día</th>
            <th scope="col">Activo</th>
            <th scope="col">Turno mañana</th>
            <th scope="col">Turno tarde</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($diastrabajo as $key => $item)
          <tr>
            <th>{{ $dias[$key] }}</th>
            <td>
              <label class="custom-toggle">
                <input type="checkbox" name="estado[]" value="{{ $key }}"
                  @if($item->estado) checked @endif>
                <span class="custom-toggle-slider rounded-circle"></span>
              </label>
            </td>
            <td>
              <div class="row">
                <div class="col">
                  <select class="form-control" name="turno1Inicio[]">
                    @for ($i=5; $i<=11; $i++)
                      <option value="{{ ($i<10 ? '0' : '') . $i }}:00" 
                        @if($i.':00 AM' == $item->turno1Inicio) selected @endif>
                        {{ $i }}:00 AM
                      </option>
                      <option value="{{ ($i<10 ? '0' : '') . $i }}:30"
                        @if($i.':30 AM' == $item->turno1Inicio) selected @endif>
                        {{ $i }}:30 AM
                      </option>
                    @endfor
                  </select>
                </div>
                <div class="col">
                  <select class="form-control" name="turno1Fin[]">
                    @for ($i=5; $i<=11; $i++)
                    <option value="{{ ($i<10 ? '0' : '') . $i }}:00"
                      @if($i.':00 AM' == $item->turno1Fin) selected @endif>
                      {{ $i }}:00 AM
                    </option>
                    <option value="{{ ($i<10 ? '0' : '') . $i }}:30"
                      @if($i.':30 AM' == $item->turno1Fin) selected @endif>
                      {{ $i }}:30 AM
                    </option>
                    @endfor
                  </select>
                </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col">
                  <select class="form-control" name="turno2Inicio[]">
                    @for ($i=1; $i<=11; $i++)
                      <option value="{{ $i+12 }}:00"
                        @if($i.':00 PM' == $item->turno2Inicio) selected @endif>
                        {{ $i }}:00 PM
                      </option>
                      <option value="{{ $i+12 }}:30"
                        @if($i.':30 PM' == $item->turno2Inicio) selected @endif>
                        {{ $i }}:30 PM
                      </option>
                    @endfor
                  </select>
                </div>
                <div class="col">
                  <select class="form-control" name="turno2Fin[]">
                    @for ($i=1; $i<=11; $i++)
                      <option value="{{ $i+12 }}:00"
                        @if($i.':00 PM' == $item->turno2Fin) selected @endif>
                        {{ $i }}:00 PM
                      </option>
                      <option value="{{ $i+12 }}:30"
                        @if($i.':30 PM' == $item->turno2Fin) selected @endif>
                        {{ $i }}:30 PM
                      </option>
                    @endfor
                  </select>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</form>
@endsection
