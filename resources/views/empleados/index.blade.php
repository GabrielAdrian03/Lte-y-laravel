@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Empleados</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Tareas</th>
                    <th>Asignar Tareas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                    <td>{{ $empleado->dni }}</td>
                    <td>
                        @foreach($empleado->tareas as $tarea)
                            <span class="badge bg-info">{{ $tarea->nombre }}</span>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('empleados.asignarTareas', $empleado->id) }}" method="POST">
                            @csrf
                            @foreach($tareas as $tarea)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tareas[]" value="{{ $tarea->id }}"
                                    {{ $empleado->tareas->contains($tarea->id) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $tarea->nombre }}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Guardar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection