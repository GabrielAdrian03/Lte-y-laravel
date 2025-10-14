<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Modelos;
use App\Models\Empleados;
use App\Models\Marca;

class VehiculoController extends Controller
{
    /**
     * 📄 Mostrar la lista de vehículos + empleados (vista: poo.blade.php)
     */
    public function index(Request $request)
    {
        // 🔹 Filtros
        $modelo_id = $request->modelo_id;
        $desde = $request->desde;
        $hasta = $request->hasta;

        // 🔹 Consulta base con relaciones (marca y modelo)
        $query = Vehiculo::with(['modelo.marca']);

        if ($modelo_id) {
            $query->where('modelo_id', $modelo_id);
        }

        if ($desde) {
            $query->whereDate('created_at', '>=', $desde);
        }

        if ($hasta) {
            $query->whereDate('created_at', '<=', $hasta);
        }

        $vehiculos = $query->orderBy('created_at', 'desc')->get();

        // 🔹 Modelos para el filtro
        $modelos = Modelos::all();

        // 🔹 Empleados con tareas asignadas
        $empleados = Empleados::with('tareas')->get();

        // 🔹 Retornar todo a la vista principal (poo.blade.php)
        return view('poo', compact('vehiculos', 'modelos', 'empleados', 'modelo_id', 'desde', 'hasta'));
    }

    /**
     * 🚗 Mostrar formulario de creación de vehículo
     */
    public function create()
    {
        $modelos = Modelos::all();
        $marcas = Marca::all();

        return view('vehiculos.create', compact('modelos', 'marcas'));
    }

    /**
     * 💾 Guardar un nuevo vehículo
     */
    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|string|max:20|unique:vehiculos,patente',
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'estado' => 'nullable|string|max:50',
            'fecha_vtv' => 'nullable|date',
            'fecha_cambio_neumaticos' => 'nullable|date',
            'cantidad_puertas' => 'nullable|integer|min:1|max:10',
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('poo')->with('success', '✅ Vehículo registrado exitosamente.');
    }

    /**
     * ❌ Eliminar un vehículo
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('poo')->with('success', '🗑️ Vehículo eliminado correctamente.');
    }
}
