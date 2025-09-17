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
<!-- Descarga del informe -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informe Administrativo</h3>
    </div>
    <div class="card-body">
        <p>Empleados</p>
        <a href="{{ route('informe.descargar') }}" class="btn btn-info">
            Descargar Informe
    </div>
</div>
@endsection