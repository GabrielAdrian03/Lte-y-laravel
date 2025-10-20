@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📋 Tablero de Tareas</h5>
                    {{-- 🔹 Crear tarea (solo visible si el usuario tiene permiso) --}}
                    @can('crear tareas')
                        <a href="{{ route('tareas.create') }}" class="btn btn-success mb-3">
                            <i class="fas fa-plus-circle"></i> Nueva Tarea
                        </a>
                    @endcan
                </div>

                <div class="card-body">
                    {{-- 🔹 Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- 🔹 Tabla de tareas --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tareas as $tarea)
                                    <tr>
                                        <td>{{ $tarea->id }}</td>
                                        <td>{{ $tarea->nombre }}</td>
                                        <td class="text-center">
                                            {{-- 🔹 Botón editar --}}
                                            @can('editar tareas')
                                                <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                            @endcan

                                            {{-- 🔹 Botón eliminar --}}
                                            @can('eliminar tareas')
                                                <form action="{{ route('tareas.destroy', $tarea->id) }}" 
                                                      method="POST" 
                                                      style="display:inline-block;"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            No hay tareas registradas actualmente.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div> {{-- card-body --}}
            </div> {{-- card --}}
        </div>
    </div>
</div>
@endsection
