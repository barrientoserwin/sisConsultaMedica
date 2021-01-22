@extends('layouts.panel')

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
@endsection

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Editar Paciente</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('/paciente') }}" class="btn btn-sm btn-default">
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

      <form action="{{ url('/paciente/update/'.$paciente->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Nombre del Paciente</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $paciente->name) }}" required>
        </div>
        <div class="form-group">
          <label for="apellidos">Apellidos del Paciente</label>
          <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $paciente->apellidos) }}" required>
        </div>
        <div class="form-group">
          <label for="dni">DNI</label>
          <input type="text" name="dni" class="form-control" value="{{ old('dni', $paciente->dni) }}">
        </div>
        <div class="form-group">
          <label for="fechaNac">Fecha Nacimiento</label>
          <input type="date" name="fechaNac" class="form-control" value="{{ old('fechaNac', $paciente->fechaNac) }}">
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono / móvil</label>
          <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
        </div>
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" class="form-control" value="{{ old('email', $paciente->email) }}">
        </div> 
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="text" name="password" class="form-control" value="">
          <p>Ingrese un valor sólo si desea modificar la contraseña.</p>
        </div>
        <button type="submit" class="btn btn-primary">
          Modificar
        </button>
      </form>
    </div>
  </div>
@endsection