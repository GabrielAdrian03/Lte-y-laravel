@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registrar Vehículo</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('vehiculos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="patente" class="form-label">Patente</label>
                <input type="text" class="form-control" id="patente" name="patente" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="mb-3">
                <label for="fecha_vtv" class="form-label">Fecha VTV</label>
                <input type="date" class="form-control" id="fecha_vtv" name="fecha_vtv" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="mb-3">
                <label for="fecha_cambio_neumaticos" class="form-label">Fecha estimada para cambio de neumáticos</label>
                <input type="date" class="form-control" id="fecha_cambio_neumaticos" name="fecha_cambio_neumaticos" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_puertas" class="form-label">Cantidad de puertas</label>
                <input type="number" class="form-control" id="cantidad_puertas" name="cantidad_puertas" min="1" required>
            </div>
            <div class="mb-3">
                <label for="anio" class="form-label">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" min="1900" max="{{ date('Y') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection