<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;  // modelo en plural
use App\Models\Empleados; // modelo en plural
use App\Models\Modelos;   // modelo en plural
use App\Models\Vehiculo;  // suponiendo que este modelo está en singular

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Listado de clientes paginados
        $clientes = Cliente::latest()->paginate(10);

        // Listado de empleados con sus tareas
        $empleados = Empleados::with('tareas')->get();

        // Listado de modelos
        $modelos = Modelos::all();

        // Filtrado de vehículos según formulario
        $vehiculos = Vehiculo::query();

        if ($request->filled('modelo_id')) {
            $vehiculos->where('modelo_id', $request->modelo_id);
        }

        if ($request->filled('desde')) {
            $vehiculos->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $vehiculos->whereDate('created_at', '<=', $request->hasta);
        }

        $vehiculos = $vehiculos->get();

        return view('poo', compact('clientes', 'empleados', 'modelos', 'vehiculos'));
    }
}
