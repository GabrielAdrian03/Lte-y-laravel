<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Empleados;
use App\Models\Vehiculo;

class ArchivoController extends Controller
{
// ...funcion para descargar informe en PDF...
        public function descargarInforme()
    {
        $empleados = Empleados::all();
        $vehiculos = Vehiculo::all();

        $pdf = Pdf::loadView('informes.admin', compact('empleados', 'vehiculos'));
        return $pdf->download('informe_administrativo.pdf');
    }

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
            'archivo' => 'required|file|max:10240', // 10MB máximo
        ]);

        $path = $request->file('archivo')->store('archivos');

        return back()->with('success', 'Archivo subido correctamente.');
    }

    public function descargar($archivo)
    {
        return Storage::download('archivos/' . $archivo);
    }
}