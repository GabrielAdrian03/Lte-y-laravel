<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{

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