<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleados;

class EmpleadoController extends Controller
{
    // Mostrar análisis de tareas asignadas a empleados
    public function tareasAsignadas()
    {
        $empleados = \App\Models\Empleados::with('tareas')->get();
        return view('analisis', compact('empleados'));
    }

    // Asignar tareas a un empleado
    public function asignarTareas(Request $request, $id)
    {
        $empleado = \App\Models\empleados::findOrFail($id);
        $empleado->tareas()->sync($request->tareas ?? []);
        return redirect()->route('analisis')
        ->with('success', 'Tareas asignadas correctamente.');
    }

    // Mostrar lista de empleados
    public function index()
    {
        $empleados = \App\Models\empleados::with('tareas')->get();
        $tareas = \App\Models\Tarea::all();
        return view('empleados.index', compact('empleados', 'tareas'));
    }

    // Mostrar formulario para crear un nuevo empleado
    public function create()
    {
        return view('empleados.create');
    }

    // Almacenar un nuevo empleado en la base de datos  
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:empleados,dni',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string|max:20',
            'estado_civil' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email',
        ]);

        Empleados::create($request->all());

        return redirect()->route('poo')->with('success', 'Empleado registrado exitosamente.');
    }
    // Actualizar un empleado
    public function update(Request $request, $id)
    {
        $empleado = Empleados::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:empleados,dni,' . $empleado->id,
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
        ]);

        $empleado->update($request->all());

        return redirect()->route('poo')->with('success', 'Empleado actualizado correctamente.');
    }

    // Eliminar empleado
    public function destroy($id)
    {
        $empleado = Empleados::findOrFail($id);
        $empleado->delete();

        return redirect()->route('poo')->with('success', 'Empleado eliminado correctamente.');
    }
}
