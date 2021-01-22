@extends('layouts.panel')

@section('content')   
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Pacientes</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('/paciente/create') }}" class="btn btn-sm btn-success">Nuevo Paciente</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if (session('notificacion'))
          <div class="alert alert-success" role="alert">
            {{ session('notificacion') }}
          </div>
      @endif
    </div>
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">DNI</th>
            <th scope="col">Fecha Nacimiento</th>
            <th scope="col">Telefono</th>
            <th scope="col">Direccion</th>
            <th scope="col">E-mail</th>           
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($paciente as $item)
              <tr>
              <th scope="row">{{ $item->name }}</th>
              <td>{{ $item->apellidos }}</td> 
              <td>{{ $item->dni }}</td> 
              <td>{{ $item->fechaNac }}</td>    
              <td>{{ $item->telefono }}</td>   
              <td>{{ $item->direccion }}</td>
              <td>{{ $item->email }}</td>  
              <td>                
                <form action="{{ url('/paciente/delete/'.$item->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <a href="{{ url('/paciente/edit/'.$item->id) }}" class="btn btn-sm btn-primary">Modificar</a>
                  <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>                
              </td>
            </tr>
          @endforeach          
        </tbody>
      </table>
    </div>
    <div class="card-body">
      {{ $paciente->links() }}
    </div>
  </div>
@endsection
