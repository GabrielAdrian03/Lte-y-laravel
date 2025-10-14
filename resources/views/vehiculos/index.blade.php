@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Vehículos</h2>
    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Nuevo Vehículo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $v)
            <tr>
                <td>{{ $v->patente }}</td>
                <td>{{ $v->marca->nombre }}</td>
                <td>{{ $v->modelo->nombre }}</td>
                <td>{{ $v->anio }}</td>
                <td>{{ $v->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    @include('vehiculos.busqueda')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
@endsection
