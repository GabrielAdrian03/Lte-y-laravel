@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Vacaciones</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('vacaciones.index') }}" class="btn btn-primary ms-2">
            Ver Vacaciones
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Seccion de asignacion de tareas</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('empleados.index') }}" class="btn btn-primary ms-2">
            Asignar Tareas a Empleados
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tareas asignadas al personal</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>DNI</th>
                    <th>Tareas Asignadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                    <td>{{ $empleado->dni }}</td>
                    <td>
                        @forelse($empleado->tareas as $tarea)
                            <span class="badge bg-info">{{ $tarea->nombre }}</span>
                        @empty
                            <span class="text-muted">Sin tareas asignadas</span>
                        @endforelse
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection