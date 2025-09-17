@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Descripción del Vehículo: {{ $vehiculo->patente }}</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('vehiculos.descripcion.store', $vehiculo->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="estado_general" class="form-label">Estado General</label>
                <input type="text" class="form-control" id="estado_general" name="estado_general" required>
            </div>
            <div class="mb-3">
                <label for="piezas_daniadas" class="form-label">Piezas dañadas o faltantes</label>
                <textarea class="form-control" id="piezas_daniadas" name="piezas_daniadas" required></textarea>
            </div>
            <div class="mb-3">
                <label for="precio_servicio" class="form-label">Precio del servicio</label>
                <input type="number" step="0.01" class="form-control" id="precio_servicio" name="precio_servicio" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Descripción</button>
        </form>
    </div>
</div>
@endsection