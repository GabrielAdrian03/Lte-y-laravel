@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Programación Orientada a Objetos (POO)</h3>
    </div>
    <div class="card-body">
        <p>Sección del jefe</p>
        <a href="{{ route('empleados.create') }}" class="btn btn-success">
            Registrar Empleado
        </a>
        <a href="{{ route('empleados.index') }}" class="btn btn-primary ms-2">
            Asignar Tareas a Empleados
        </a>
    </div>
    <div class="card-body">
        <p>Bienvenido al apartado de vacaciones!.</p>

    </div>
</div>
@endsection