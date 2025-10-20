@extends('layouts.admin')
@section('content')

<!-- Tarjeta Vacaciones -->
<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Vacaciones</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('vacaciones.index') }}" class="btn btn-primary ms-2">
            Ver Vacaciones
        </a>
    </div>
</div>

<!-- Tarjeta Asignación de Tareas -->
<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Sección de asignación de tareas</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('empleados.index') }}" class="btn btn-primary ms-2">
            Asignar Tareas a Empleados
        </a>
    </div>
</div>

<!-- Tarjeta Tareas Asignadas -->
<div class="card mb-3">
    <div class="card-header bg-info text-white">
        <h3 class="card-title mb-0">Tareas asignadas al personal</h3>
    </div>
    <div class="card-body">
        @if($empleados->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle shadow-sm">
                    <thead class="table-info text-center">
                        <tr>
                            <th>Empleado</th>
                            <th>DNI</th>
                            <th>Tareas Asignadas</th>
                            <th>Vehículo Asignado</th>
                            <th>Cliente Asignado</th>
                            <th>Dirección del Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <!-- Nombre del empleado -->
                                <td><strong>{{ $empleado->nombre }} {{ $empleado->apellido }}</strong></td>

                                <!-- DNI -->
                                <td>{{ $empleado->dni }}</td>

                                <!-- Tareas -->
                                <td>
                                    @forelse($empleado->tareas as $tarea)
                                        <span class="badge bg-info text-dark">{{ $tarea->nombre }}</span>
                                    @empty
                                        <span class="text-muted">Sin tareas asignadas</span>
                                    @endforelse
                                </td>

                                <!-- Vehículo asignado -->
                                <td>
                                    @if($empleado->vehiculo)
                                        <strong>{{ $empleado->vehiculo->marca->nombre ?? '' }}</strong>
                                        {{ $empleado->vehiculo->modelo->nombreModelo ?? '' }}<br>
                                        <small class="text-muted">Patente: {{ $empleado->vehiculo->patente }}</small>
                                    @else
                                        <span class="text-muted">No asignado</span>
                                    @endif
                                </td>

                                <!-- Cliente asignado -->
                                <td>
                                    @if($empleado->cliente)
                                        {{ $empleado->cliente->nombres }} {{ $empleado->cliente->apellido }}
                                    @else
                                        <span class="text-muted">No asignado</span>
                                    @endif
                                </td>

                                <!-- Dirección del cliente -->
                                <td>
                                    @if($empleado->cliente && $empleado->cliente->direccion)
                                        {{ $empleado->cliente->direccion }}
                                    @else
                                        <span class="text-muted">Sin dirección</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No hay empleados registrados.</p>
        @endif
    </div>
</div>

@endsection
