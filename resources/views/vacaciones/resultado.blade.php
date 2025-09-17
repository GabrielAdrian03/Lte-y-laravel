<!DOCTYPE html>
<html>
<head>
    <title>Resultado de Vacaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .box {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background: #f9f9f9;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Vacaciones confirmadas 🎉</h1>
        <p>Fecha de inicio: <strong>{{ $fechaInicio }}</strong></p>
        <p>Fecha de fin: <strong>{{ $fechaFin }}</strong></p>

        <a href="{{ route('vacaciones.index') }}">Volver</a>
    </div>
</body>
</html>
