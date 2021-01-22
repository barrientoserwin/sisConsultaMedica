<h6 class="navbar-heading text-muted">
    @if (Auth::user()->rolUsuario == 'administrador')
        GESTIONAR DATOS
    @else
        Menú
    @endif
</h6>
<!-- Navigation -->
<ul class="navbar-nav">
    @include('includes.panel.menu.' . Auth::user()->rolUsuario)
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ni ni-key-25"></i> Cerrar sesión</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </li>
</ul>
@if (Auth::user()->rolUsuario == 'administrador')
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/charts/consultamedica/line') }}">
            <i class="ni ni-collection text-red"></i> Frecuencia de citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/charts/medico/column') }}">
            <i class="ni ni-spaceship"></i> Médicos mas activos
        </a>
    </li>
</ul>
@endif