<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleados;

class EmpleadoController extends Controller
{

    public function tareasAsignadas()
    {
        $empleados = \App\Models\empleados::with('tareas')->get();
        return view('analisis', compact('empleados'));
    }
    public function asignarTareas(Request $request, $id)
    {
        $empleado = \App\Models\empleados::findOrFail($id);
        $empleado->tareas()->sync($request->tareas ?? []);
        return redirect()->route('empleados.index')->with('success', 'Tareas asignadas correctamente.');
    }

    public function index()
    {
        $empleados = \App\Models\empleados::with('tareas')->get();
        $tareas = \App\Models\Tarea::all();
        return view('empleados.index', compact('empleados', 'tareas'));
    }
    public function create()
    {
        return view('empleados.create');
    }

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

        return redirect()->route('empleados.create')->with('success', 'Empleado registrado exitosamente.');
    }
}
