<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Informe Administrativo</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 18px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; vertical-align: top; }
        th { background: #f2f2f2; }
        .small { font-size: 11px; color: #333; }
        .no-border td { border: none; padding: 2px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Informe Administrativo</h2>
        <p class="small">Generado: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @foreach($empleados as $empleado)
        @php
            $veh = $empleado->vehiculo ?? null;

            // Marca: puede venir como string o como relación (objeto con nombre)
            $marca = '';
            if ($veh) {
                if (is_string(optional($veh)->marca)) {
                    $marca = $veh->marca;
                } else {
                    $marca = optional(optional($veh)->marca)->nombre
                          ?? optional(optional($veh)->marca)->nombreMarca
                          ?? '';
                }
            }

            // Modelo: puede venir como string o como relación/array con nombre
            $modelo = '';
            if ($veh) {
                if (is_string(optional($veh)->modelo)) {
                    $modelo = $veh->modelo;
                } else {
                    $modelo = optional(optional($veh)->modelo)->nombreModelo
                           ?? optional(optional($veh)->modelo)->nombre
                           ?? '';
                }
            }

            $patente = $veh->patente ?? '';
        @endphp

        <div class="section">
            <table>
                <tr>
                    <th colspan="4">Empleado</th>
                </tr>
                <tr>
                    <td><strong>Apellido y Nombre</strong></td>
                    <td>{{ ($empleado->apellido ?? '') . ' ' . ($empleado->nombre ?? $empleado->nombres ?? '') }}</td>
                    <td><strong>DNI</strong></td>
                    <td>{{ $empleado->dni ?? '' }}</td>
                </tr>
                <tr>
                    <th>Vehículo (Marca / Modelo)</th>
                    <th>Patente</th>
                    <th>Cliente asignado</th>
                    <th>Contacto / Dirección</th>
                </tr>
                <tr>
                    <td>{{ trim(($marca . ' ' . $modelo)) ?: '-' }}</td>
                    <td>{{ $patente ?: '-' }}</td>
                    <td>
                        @if($empleado->cliente)
                            {{ $empleado->cliente->apellido ?? '' }}, {{ $empleado->cliente->nombres ?? $empleado->cliente->nombre ?? '' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($empleado->cliente)
                            {{ $empleado->cliente->dni ?? '' }} / {{ $empleado->cliente->direccion ?? '' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width:6%;">#</th>
                    <th style="width:30%;">Tarea</th>
                    <th style="width:34%;">Descripción / Detalles</th>
                    <th style="width:15%;">Estado</th>
                    <th style="width:15%;">Fecha</th>
                </tr>

                @if($empleado->tareas && $empleado->tareas->count())
                    @foreach($empleado->tareas as $i => $tarea)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $tarea->nombre ?? $tarea->titulo ?? 'Tarea' }}</td>
                            <td>{{ $tarea->descripcion ?? $tarea->detalle ?? '-' }}</td>
                            <td>{{ $tarea->estado ?? $tarea->status ?? '-' }}</td>
                            <td>
                                {{ optional($tarea->created_at)->format('d/m/Y') ?? optional($tarea->fecha)->format('d/m/Y') ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="small">No tiene tareas asignadas.</td>
                    </tr>
                @endif
            </table>
        </div>
        <hr>
    @endforeach

    <p class="small">Fin del informe</p>
</body>
</html>