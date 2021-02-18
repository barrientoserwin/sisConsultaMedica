<div class="table-responsive">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Descripción</th>
        <th scope="col">Especialidad</th>
        @if ($rolUsuario == 'paciente')
          <th scope="col">Médico</th>
        @elseif ($rolUsuario == 'doctor')
          <th scope="col">Paciente</th>
        @endif
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Tipo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($consultaConfirmada as $item)
      <tr>
        <th scope="row">{{ $item->descripcion }}</th>
        <td>{{ $item->nombreEspecialidad }}</td>
        @if ($rolUsuario == 'paciente')
          <td>{{ $item->nombreMedico }}</td>
        @elseif ($rolUsuario == 'doctor')
          <td>{{ $item->nombrePaciente }}</td>
        @endif
        <td>{{ $item->fechaConsulta }}</td>
        <td>{{ \Carbon\Carbon::parse(strtotime($item->horaConsulta))->format('g:i A') }}</td>
        <td>{{ $item->tipoConsulta }}</td>
        <td>
          @if ($rolUsuario == 'administrador')
            <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Ver cita" 
              href="{{ url('/consultamedica/verConsulta/'.$item->id) }}">
                Ver
            </a>
          @endif
          @if ($rolUsuario == 'doctor')
            <form action="{{ url('/consultamedica/consultaAtend/'.$item->id) }}" 
              method="POST" class="d-inline-block">
              @csrf
              <button class="btn btn-sm btn-success" type="submit" data-toggle="tooltip" title="Marcar atendida">Atendida</button>
            </form>
          @endif
          <a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Cancelar cita" 
            href="{{ url('/consultamedica/cancelarConfir/'.$item->id) }}">
              Cancelar
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
  {{ $consultaConfirmada->links() }}
</div>