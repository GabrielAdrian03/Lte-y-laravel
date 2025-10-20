@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ingreso') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address Field -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Dirección e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field con Ojo para mostrar/ocultar -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6" style="position: relative;">
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password" style="padding-right: 2.5rem;">

                                <!-- Ícono para mostrar/ocultar -->
                                <span id="togglePwd" style="position: absolute; right: -15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    👁️
                                </span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button and Forgot Password Link -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    const toggle = document.getElementById('togglePwd');
    const pwd = document.getElementById('password');

    toggle.addEventListener('click', () => {
        if (pwd.type === 'password') {
            pwd.type = 'text';
            toggle.textContent = '🙈'; 
        } else {
            pwd.type = 'password';
            toggle.textContent = '👁️'; 
        }
    });
</script>
@endsection
