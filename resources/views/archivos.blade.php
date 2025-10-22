@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Subir archivo</h2>
    <hr>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('archivos.subir') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo" required>
        <button type="submit" class="btn btn-primary">  Subir</button>
    </form>
    <ul>
        @foreach(Storage::files('archivos') as $file)
        <li>
            {{ basename($file) }}
            <a href="{{ route('archivos.descargar', basename($file)) }}" class="btn btn-success btn-sm">Descargar</a>
            <form action="{{ route('archivos.eliminar', basename($file)) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este archivo?')">Eliminar</button>
            </form>
        </li>
    @endforeach
    </ul>
</div>
<!-- ...existing code... -->
<!-- Descarga del informe -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informe Administrativo</h3>
    </div>
    <div class="card-body">
        <!-- Formulario GET para filtrar por fecha antes de descargar -->
        <form action="{{ route('informe.descargar') }}" method="GET" class="form-inline">
            <div class="form-group mr-2">
                <label for="desde" class="mr-1">Desde</label>
                <input type="date" name="desde" id="desde" class="form-control" value="{{ request('desde') }}">
            </div>

            <div class="form-group mr-2">
                <label for="hasta" class="mr-1">Hasta</label>
                <input type="date" name="hasta" id="hasta" class="form-control" value="{{ request('hasta') }}">
            </div>

            <button type="submit" class="btn btn-info">Descargar Informe</button>
        </form>

        <p class="small mt-2 text-muted">Dejar vacío si desea descargar el informe desde el principio.</p>
    </div>
</div>
<!-- ...existing code... -->
@endsection