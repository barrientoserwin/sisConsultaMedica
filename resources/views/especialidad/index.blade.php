@extends('layouts.panel')

@section('content')   
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Especialidades</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('/especialidad/create') }}" class="btn btn-sm btn-success">Nueva Especialidad</a>
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
            <th scope="col">Descripción</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($especialidad as $item)
              <tr>
              <th scope="row">
                {{ $item->nombre }}
              </th>
              <td>
                {{ $item->descripcion }}
              </td>           
              <td>                
                <form action="{{ url('/especialidad/delete/'.$item->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <a href="{{ url('/especialidad/edit/'.$item->id) }}" class="btn btn-sm btn-primary">Modificar</a>
                  <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>                
              </td>
            </tr>
          @endforeach          
        </tbody>
      </table>
    </div>
  </div>
@endsection
