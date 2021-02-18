@extends('layouts.panel')

@section('content')
  <div class="card shadow">    
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Detalles del Medico</h3>
        </div>
      </div>
    </div>
    <div class="card-body">
        <h4 class="mb-0">Datos personales:</h4>
      <ul>
        <li><strong>Nombre:</strong> {{ $medico->name }}</li>
        <li><strong>Apellidos:</strong> {{ $medico->apellidos }}</li>
        <li><strong>Email:</strong> {{ $medico->email }}</li>
        <li><strong>Nro Carnet:</strong> {{ $medico->dni }}</li>
        <li><strong>Fecha Nacimiento:</strong> {{ $medico->fechaNac }}</li>
        <li><strong>Telefono:</strong> {{ $medico->telefono }}</li>
        <li><strong>Direccion:</strong> {{ $medico->direccion }}</li>
      </ul>
      
      <h4 class="mb-0">Especialidades médicas:</h4>
      <ul>
        @foreach($especialidad as $item)
            <li>{{$item->nombre}}</li>
        @endforeach
       </ul>

       <h4 class="mb-0">Dias de Trabajo:</h4>
       <div class="table-responsive">
        <table class="table align-items-center table-flush">
         <thead class="thead-light">
           <tr>
             <th scope="col">Día</th>
             <th scope="col">Turno mañana</th>
             <th scope="col">Turno tarde</th>
           </tr>
         </thead>
         <tbody>
           @foreach ($diastrabajo as $key => $item)
                <tr>
                    <th>{{ $dias[$key] }}</th>
                    <td>
                    <div class="row">
                        <div class="col">
                            {{ \Carbon\Carbon::parse(strtotime($item->turno1Inicio))->format('g:i A') }}
                        </div>
                        <div class="col">
                            {{ \Carbon\Carbon::parse(strtotime($item->turno1Fin))->format('g:i A') }}
                        </div>
                    </div>
                    </td>
                    <td>
                    <div class="row">
                        <div class="col">
                            {{ \Carbon\Carbon::parse(strtotime($item->turno2Inicio))->format('g:i A') }}
                        </div>
                        <div class="col">
                            {{ \Carbon\Carbon::parse(strtotime($item->turno2Fin))->format('g:i A') }}
                        </div>
                    </div>
                    </td>
                </tr>
           @endforeach
         </tbody>
       </table>
     </div>

     <br>
     <br>
      <a href="{{ url('/medico') }}" class="btn btn-default">
        Volver
      </a>
    </div>   
  </div>
@endsection
