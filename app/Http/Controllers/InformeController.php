<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InformeController extends Controller
{
    public function descargar()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="informe_empleados.csv"',
        ];

        $callback = function () {
            $output = fopen('php://output', 'w');
            // Cabecera CSV
            fputcsv($output, [
                'Empleado',
                'DNI Empleado',
                'Tarea',
                'Vehículo (marca)',
                'Patente',
                'Cliente Apellido',
                'Cliente Nombres',
                'Cliente DNI',
                'Cliente Dirección'
            ]);

            // Intentamos cargar relaciones más comunes. Ajusta nombres de relaciones si tu modelo usa otros.
            $empleados = \App\Models\Empleado::with(['tareas', 'vehiculo', 'cliente', 'vehiculo.marca'])->get();

            foreach ($empleados as $empleado) {
                $empleadoNombre = trim(($empleado->apellido ?? '') . ' ' . ($empleado->nombre ?? $empleado->nombres ?? ''));

                // Si el empleado tiene tareas, una fila por tarea
                if ($empleado->relationLoaded('tareas') && $empleado->tareas->isNotEmpty()) {
                    foreach ($empleado->tareas as $tarea) {
                        // Intentar obtener cliente ligado a la tarea o al empleado
                        $cliente = $tarea->cliente ?? ($empleado->cliente ?? null);
                        $vehiculo = $empleado->vehiculo ?? null;

                        fputcsv($output, [
                            $empleadoNombre,
                            $empleado->dni ?? '',
                            $tarea->descripcion ?? $tarea->nombre ?? '',
                            $vehiculo->marca->nombre ?? ($vehiculo->marca ?? '') ?? '',
                            $vehiculo->patente ?? '',
                            $cliente->apellido ?? '',
                            $cliente->nombres ?? $cliente->nombre ?? '',
                            $cliente->dni ?? '',
                            $cliente->direccion ?? '',
                        ]);
                    }
                } else {
                    // Sin tareas: una fila vacía en campo tarea
                    $vehiculo = $empleado->vehiculo ?? null;
                    $cliente = $empleado->client ?? ($empleado->cliente ?? null);

                    fputcsv($output, [
                        $empleadoNombre,
                        $empleado->dni ?? '',
                        '',
                        $vehiculo->marca->nombre ?? ($vehiculo->marca ?? '') ?? '',
                        $vehiculo->patente ?? '',
                        $cliente->apellido ?? '',
                        $cliente->nombres ?? $cliente->nombre ?? '',
                        $cliente->dni ?? '',
                        $cliente->direccion ?? '',
                    ]);
                }
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}