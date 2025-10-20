@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Clientes</h3></div>
    <div class="card-body">
        <a href="{{ route('clientes.create') }}" class="btn btn-success mb-3">Nuevo Cliente</a>

        <table class="table">
            <thead>
                <tr><th>Apellido</th><th>Nombres</th><th>DNI</th><th>Dirección</th></tr>
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

        {{ $clientes->links() }}
    </div>
</div>
@endsection