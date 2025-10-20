@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registrar Nuevo Cliente</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido/s</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
                @error('apellido') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="form-control" value="{{ old('nombres') }}" required>
                @error('nombres') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni') }}" required>
                @error('dni') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                @error('direccion') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </form>
    </div>
</div>
@endsection
