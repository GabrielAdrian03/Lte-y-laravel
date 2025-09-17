@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Seccion del Personal</h3>
    </div>
    <div class="card-body">
        <p>Empleados</p>
        <a href="{{ route('empleados.create') }}" class="btn btn-success">
            Registrar Empleado
        </a>
    </div>
</div>
<!-- Segunda tarjeta para vehiculos -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sección Vehicular</h3>
    </div>
    <div class="card-body">
        <p>Vehiculos</p>
        <a href="{{ route('vehiculos.create') }}" class="btn btn-success">
            Registrar Vehiculo
        </a>
        <!-- Tabla de vehículos registrados -->
        <table class="table mt-4">
            <thead>
    <tr>
        <th>Patente</th>
        <th>Modelo</th>
        <th>Estado</th>
        <th>Año</th>
        <th>Fallo</th> <!-- Nueva columna para mostrar el fallo -->
        <th>Acciones</th>
        <th>Agregar Fallo</th>
    </tr>
</thead>
<tbody>
    @foreach(\App\Models\Vehiculo::all() as $vehiculo)
    <tr>
        <td>{{ $vehiculo->patente }}</td>
        <td>{{ $vehiculo->modelo }}</td>
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
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection