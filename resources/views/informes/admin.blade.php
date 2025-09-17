<!DOCTYPE html>
<html>
<head>
    <title>Informe Administrativo</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
        th, td { border: 1px solid #333; padding: 5px; text-align: left;}
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->dni }}</td>
                <td>{{ $empleado->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Vehículos</h2>
    <table>
        <thead>
            <tr>
                <th>Patente</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->patente }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->estado }}</td>
                <td>{{ $vehiculo->anio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>