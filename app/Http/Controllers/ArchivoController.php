<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Empleados;
use App\Models\Vehiculo;

class ArchivoController extends Controller
{
    public function index()
    {
        return view('archivos');
    }
// ...funcion para descargar informe en PDF...

    public function descargarInforme(Request $request)
    {
        $desde = $request->query('desde');
        $hasta = $request->query('hasta');

        // Eager load tareas (filtradas) y relaciones necesarias.
        $empleadosQuery = \App\Models\Empleados::with([
            'tareas' => function($q) use ($desde, $hasta) {
                // Calificar created_at para evitar ambigüedad
                if ($desde && $hasta) {
                    $q->whereBetween(\DB::raw('DATE(tareas.created_at)'), [$desde, $hasta]);
                } else {
                    if ($desde) $q->whereDate('tareas.created_at', '>=', $desde);
                    if ($hasta) $q->whereDate('tareas.created_at', '<=', $hasta);
                }
            },
            'vehiculo',
            'cliente'
        ]);

        // Asegurar traer solo empleados con tareas en el rango (o con cualquier tarea si no hay filtro)
        if ($desde || $hasta) {
            $empleadosQuery->whereHas('tareas', function($q) use ($desde, $hasta) {
                if ($desde && $hasta) {
                    $q->whereBetween(\DB::raw('DATE(tareas.created_at)'), [$desde, $hasta]);
                } else {
                    if ($desde) $q->whereDate('tareas.created_at', '>=', $desde);
                    if ($hasta) $q->whereDate('tareas.created_at', '<=', $hasta);
                }
            });
        } else {
            $empleadosQuery->whereHas('tareas');
        }

        $empleados = $empleadosQuery->get();

        $pdf = Pdf::loadView('informes.admin', compact('empleados', 'desde', 'hasta'));

        return $pdf->download('informe_administrativo.pdf');
    }
// ...existing code...

// ...funcion para borrar el archivo...
public function eliminar($archivo)
{
    Storage::delete('archivos/' . $archivo);
    return back()->with('success', 'Archivo eliminado correctamente.');
}
// ...existing code...
    public function subir(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:10240',
        ]);

        $path = $request->file('archivo')->store('archivos');

        return back()->with('success', 'Archivo subido correctamente.');
    }

    public function descargar($archivo)
    {
        return Storage::download('archivos/' . $archivo);
    }
}