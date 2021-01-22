@extends('layouts.panel')

@section('content')   
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                <h3 class="mb-0">Nueva Especialidades</h3>
                </div>
                <div class="col text-right">
                <a href="{{ url('/especialidad') }}" class="btn btn-sm btn-success">Cancelar y volver</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/especialidad/store') }}" method="post">
                @csrf
                <div class=form-group>
                    <label for="nombre">Nombre de la Especialidad</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                </div>
                <div class=form-group>
                    <label for="descripcion">Descripcion de la Especialidad</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection