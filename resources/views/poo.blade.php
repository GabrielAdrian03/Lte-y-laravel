@extends('layouts.admin')

@section('content')
<!-- Tarjeta Clientes -->
<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Clientes</h3>
    </div>
    <div class="card-body">

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Botón Crear Cliente -->
        @can('crear clientes')
            <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Cliente</a>
        @endcan

        <!-- Tabla de Clientes -->
        @if($clientes->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombres</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $c)
                        <tr>
                            <td>{{ $c->apellido }}</td>
                            <td>{{ $c->nombres }}</td>
                            <td>{{ $c->dni }}</td>
                            <td>{{ $c->direccion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $clientes->links() }}
        @else
            <p class="text-muted">No hay clientes registrados.</p>
        @endif
    </div>
</div>

<!-- Tarjeta Empleados -->
<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Sección del Personal</h3>
    </div>
    <div class="card-body">
        <p>Empleados</p>
        @can('crear empleados')
            <a href="{{ route('empleados.create') }}" class="btn btn-success mb-3">
                Registrar Nuevo Empleado
            </a>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>DNI</th>
                    <th>Tareas Asignadas</th>
                    <th>Acciones</th>
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
                        <td>
                            @can('editar empleados')
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            @endcan
                            @can('eliminar empleados')
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tarjeta Vehículos -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Sección Vehicular</h3>
    </div>
    <div class="card-body">
        <p>Vehículos</p>
        @can('crear vehiculos')
            <a href="{{ route('vehiculos.create') }}" class="btn btn-success mb-3">
                Registrar Vehículo
            </a>
        @endcan

        <!-- FILTRO DE VEHÍCULOS -->
        <div class="container mt-3">
            <form action="{{ route('poo') }}" method="GET" autocomplete="on" role="search">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label for="modelo_id">Modelo</label>
                        <select name="modelo_id" id="modelo_id" class="form-control">
                            <option value="">-- Todos los modelos --</option>
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}" {{ request('modelo_id') == $modelo->id ? 'selected' : '' }}>
                                    {{ $modelo->nombreModelo ?? $modelo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label for="desde">Fecha Desde</label>
                        <input type="date" name="desde" id="desde" class="form-control" value="{{ request('desde') }}">
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <label for="hasta">Fecha Hasta</label>
                        <input type="date" name="hasta" id="hasta" class="form-control" value="{{ request('hasta') }}">
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('poo') }}" class="btn btn-secondary">
                            <i class="fas fa-eraser"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- TABLA DE VEHÍCULOS -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Patente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Año</th>
                    <th>Fallo</th>
                    <th>Acciones</th>
                    <th>Agregar Fallo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->patente }}</td>
                        <td>{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</td>
                        <td>{{ $vehiculo->modelo->nombreModelo ?? 'Sin modelo' }}</td>
                        <td>{{ $vehiculo->estado }}</td>
                        <td>{{ $vehiculo->anio }}</td>
                        <td>
                            @if($vehiculo->descripcion_fallo)
                                {{ $vehiculo->descripcion_fallo }}
                            @else
                                <span class="text-muted">Sin fallos</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('vehiculos.descripcion.create', ['vehiculo' => $vehiculo->id]) }}" class="btn btn-primary btn-sm">
                                Agregar Detalles
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="document.getElementById('fallo-{{ $vehiculo->id }}').style.display='block'">
                                Agregar Fallo
                            </button>
                            <form action="{{ route('fallo.store', ['vehiculo' => $vehiculo->id]) }}" method="POST" style="display:none;" id="fallo-{{ $vehiculo->id }}">
                                @csrf
                                <div class="input-group mt-2">
                                    <input type="text" name="descripcion_fallo" class="form-control" placeholder="Descripción del fallo" required>
                                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('fallo-{{ $vehiculo->id }}').style.display='none'">Cancelar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No hay vehículos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
