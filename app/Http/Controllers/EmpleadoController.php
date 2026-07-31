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
        $empleados = \App\Models\Empleados::with(['tareas', 'vehiculo', 'cliente'])
        ->whereHas('tareas') // solo empleados con tareas asignadas
        ->get();

        return view('analisis', compact('empleados'));
    }

    // Asignar tareas a un empleado
    public function asignarTareas(Request $request, $id)
    {
        $empleado = \App\Models\Empleados::findOrFail($id);

        $request->validate([
            'tareas' => 'array|max:5',
            'tareas.*' => 'integer|exists:tareas,id',
        ], [
            'tareas.max' => 'Solo se pueden asignar hasta 5 tareas por empleado.',
        ]);

        $empleado->tareas()->sync($request->tareas ?? []);

        return redirect()->route('analisis')
            ->with('success', 'Tareas asignadas correctamente.');
    }

    // Mostrar lista de empleados
    public function index()
    {
        $empleados = \App\Models\Empleados::with('tareas', 'vehiculos', 'clientes')->get();
        $tareas = \App\Models\Tarea::all();
        $vehiculos = \App\Models\Vehiculo::with('marca', 'modelo')->get();
        $clientes = \App\Models\Cliente::all();

        return view('empleados.index', compact('empleados', 'tareas', 'vehiculos', 'clientes'));

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
    // Asignar tareas, vehículo y cliente en un solo formulario
    public function asignarTodo(Request $request, $id)
    {
        $empleado = Empleados::findOrFail($id);

        $request->validate([
            'tareas' => 'array|max:5',
            'tareas.*' => 'integer|exists:tareas,id',
            'vehiculo_id' => 'nullable|integer|exists:vehiculos,id',
            'cliente_id' => 'nullable|integer|exists:clientes,id',
        ], [
            'tareas.max' => 'Solo se pueden asignar hasta 5 tareas por empleado.',
        ]);

        // 1️⃣ Asignar tareas
        $empleado->tareas()->sync($request->tareas ?? []);

        // 2️⃣ Asignar vehículo
        if ($request->vehiculo_id) {
            // Marcar vehículo anterior como disponible si cambia
            if ($empleado->vehiculo_id && $empleado->vehiculo_id != $request->vehiculo_id) {
                $vehiculoAnterior = \App\Models\Vehiculo::find($empleado->vehiculo_id);
                if ($vehiculoAnterior) {
                    $vehiculoAnterior->en_uso = false;
                    $vehiculoAnterior->save();
                }
            }

            $empleado->vehiculo_id = $request->vehiculo_id;

            // Marcar nuevo vehículo como en uso
            $vehiculoNuevo = \App\Models\Vehiculo::find($request->vehiculo_id);
            if ($vehiculoNuevo) {
                $vehiculoNuevo->en_uso = true;
                $vehiculoNuevo->save();
            }
        } else {
            $empleado->vehiculo_id = null;
        }

        // 3️⃣ Asignar cliente
        $empleado->cliente_id = $request->cliente_id ?? null;

        // Guardar cambios
        $empleado->save();

        return redirect()->route('analisis')->with('success', 'El empleado está de camino.');
    }

}
