@extends('layouts.admin') 
@section('content') 
<div class="card"> 
    <div class="card-header"> 
        <h3 class="card-title">Registrar Vehículo</h3> 
    </div> 
    <div class="card-body"> 
        @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}

        </div> 
        @endif 
        @if ($errors->any()) 
        <div class="alert alert-danger"> 
            <ul> @foreach ($errors->all() as $error) 
                <li>{{ $error }}

                </li>
                 @endforeach 
                </ul> 
            </div> 
            @endif 
            <form action="{{ route('vehiculos.store') }}" method="POST"> 
                @csrf <div class="mb-3"> 
                    <label for="patente" class="form-label">Patente</label> 
                    <input type="text" class="form-control" id="patente" name="patente" required> 
                </div> 
                <!-- MARCA --> 
                 <select class="form-control" id="marca_id" name="marca_id" required> 
                    <option value="">Seleccione una marca</option> 
                    @foreach($marcas as $marca) 
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}
                    </option> @endforeach 
                </select> 
                <!-- MODELO --> 
                 <select class="form-control" id="modelo_id" name="modelo_id" required> 
                    <option value="">Seleccione un modelo
                    </option> 
                </select> 
                <script src="https://code.jquery.com/jquery-3.6.0.min.js">

                </script> 
                <script> $(document).ready(function () { $('#marca_id').on('change', function () { let marca_id = $(this).val(); $('#modelo_id').empty().append('<option value="">Cargando...</option>'); 
                    if (marca_id) { $.ajax({ url: '{{ url("modelos-por-marca") }}/' + marca_id, type: 'GET', success: function (data) { $('#modelo_id').empty().append('<option value="">Seleccione un modelo</option>'); $.each(data, function (key, modelo) { $('#modelo_id').append('<option value="' + modelo.id + '">' + modelo.nombreModelo + '</option>'); }); }, error: function (xhr) { console.error("Error AJAX:", xhr.responseText); $('#modelo_id').empty().append('<option value="">Error al cargar</option>'); } }); } 
                    else { $('#modelo_id').empty().append('<option value="">Seleccione una marca primero</option>'); } }); }); 
                    </script> 
                    <div class="mb-3"> 
                        <label for="fecha_vtv" class="form-label">Fecha VTV
                        </label> 
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
        @section('scripts') <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script> $(document).ready(function () { $('#marca_id').on('change', function () { var marcaId = $(this).val(); $('#modelo_id').empty().append('<option value="">Cargando...</option>'); 
            if (marcaId) { $.ajax({ url: '/get-modelos/' + marcaId, type: 'GET', dataType: 'json', success: function (data) { $('#modelo_id').empty().append('<option value="">Seleccione un modelo</option>'); $.each(data, function (key, modelo) { $('#modelo_id').append('<option value="' + modelo.id + '">' + modelo.nombre + '</option>'); }); } }); } 
            else { $('#modelo_id').empty().append('<option value="">Seleccione una marca primero</option>'); } }); }); 
</script> 
@endsection