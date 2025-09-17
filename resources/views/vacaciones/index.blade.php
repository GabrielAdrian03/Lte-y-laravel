@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Solicitar Vacaciones</h3>
    </div>
    <div class="card-body">
        {{-- Formulario para seleccionar fecha de inicio --}}
        <form action="{{ route('vacaciones.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror"
                       name="fecha_inicio" id="fecha_inicio" required>
                @error('fecha_inicio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Guardar Vacaciones</button>
        </form>
    </div>
</div>

{{-- Card para mostrar historial de vacaciones --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Mis Vacaciones</h3>
    </div>
    <div class="card-body">
        @if($vacaciones->isEmpty())
            <p>No tenés vacaciones registradas.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Registrado el</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vacaciones as $vacacion)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($vacacion->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($vacacion->fecha_fin)->format('d/m/Y') }}</td>
                            <td>{{ $vacacion->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

@section('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
@endsection
