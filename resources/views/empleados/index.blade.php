@extends('layouts.admin')

@section('content')
<style>
    /* 🎨 Estilo general de la tabla */
    .table-custom {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .table-custom thead {
        background: linear-gradient(90deg, #007bff, #0056b3);
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    .table-custom tbody tr:hover {
        background-color: #e8f0fe;
        transition: background 0.3s ease;
    }

    /* 🎨 Celdas */
    .table-custom td, .table-custom th {
        vertical-align: middle;
        padding: 12px 15px;
    }

    /* 🎨 Selects */
    select.form-select {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 0.9rem;
        transition: all 0.2s ease-in-out;
    }

    select.form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    /* 🎨 Checkboxes */
    .form-check {
        margin-bottom: 3px;
    }

    .form-check-label {
        font-size: 0.9rem;
        margin-left: 5px;
    }

    /* 🎨 Botón Guardar */
    .btn-guardar {
        background: linear-gradient(90deg, #28a745, #218838);
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-guardar:hover {
        background: linear-gradient(90deg, #34ce57, #28a745);
        transform: scale(1.05);
    }
</style>

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Lista de Empleados</h3>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Tareas Asignadas</th>
                    <th>Seleccionar Tareas</th>
                    <th>Vehículo</th>
                    <th>Cliente</th>
                    <th>Guardar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                    <td>{{ $empleado->dni }}</td>

                    <td>
                        @foreach($empleado->tareas as $tarea)
                            <span class="badge bg-info text-dark">{{ $tarea->nombre }}</span>
                        @endforeach
                    </td>

                    <form action="{{ route('empleados.asignarTodo', $empleado->id) }}" method="POST">
                        @csrf

                        <td>
                            @foreach($tareas as $tarea)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tareas[]" value="{{ $tarea->id }}"
                                        {{ $empleado->tareas->contains($tarea->id) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $tarea->nombre }}</label>
                                </div>
                            @endforeach
                        </td>

                        <td>
                            <select name="vehiculo_id" class="form-select">
                                <option value="">-- Seleccionar Vehículo --</option>
                                @foreach($vehiculos as $vehiculo)
                                    @if(!$vehiculo->en_uso || $empleado->vehiculo_id == $vehiculo->id)
                                        <option value="{{ $vehiculo->id }}" {{ $empleado->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                                            {{ $vehiculo->marca->nombre ?? '' }} {{ $vehiculo->modelo->nombreModelo ?? '' }} ({{ $vehiculo->patente }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select name="cliente_id" class="form-select">
                                <option value="">-- Seleccionar Cliente --</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $empleado->cliente_id == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombres }} {{ $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td class="text-center">
                            <button type="submit" class="btn btn-guardar btn-sm">Guardar</button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
