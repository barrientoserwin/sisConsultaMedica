@extends('layouts.form')

@section('titulo','Inicio de sesión')
@section('subTitulo','Ingrese tu datos para iniciar sesión')

@section('content')
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              
              <form role="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Correo Electronico incorrecto</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>Contraseña incorrecta</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input name="renember" class="custom-control-input" id="renember" type="checkbox" {{ old('renember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="renember">
                    <span class="text-muted">Recordar sesión</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                  {{-- <button type="submit" class="btn btn-primary">{{ __('Login') }}</button> --}}
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
                <a href="{{ route('password.request') }}" class="text-light">
                    <small>¿Olvidaste tu contraseña?</small>
                </a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('register') }}" class="text-light">
                    <small>¿Aún no te haz registrado?</small>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
