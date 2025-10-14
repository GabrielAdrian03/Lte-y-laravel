<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Modelos;
use App\Models\Marca;

class VehiculoController extends Controller
{
    public function create()
    {
        $modelos = Modelos::all();
        $marcas = Marca::all();
        return view('vehiculos.create', compact('marcas', 'modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|string|max:20|unique:vehiculos,patente',
            'marca_id' => 'required|integer',
            'modelo_id' => 'required|integer',
            'fecha_vtv' => 'required|date',
            'estado' => 'required|string|max:50',
            'fecha_cambio_neumaticos' => 'required|date',
            'cantidad_puertas' => 'required|integer|min:1',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('poo')->with('success', 'Vehículo registrado correctamente.');
    }

    public function index(Request $request)
{
    // Cargar todos los modelos (asegurate que el modelo se llame exactamente "Modelos")
    $modelos = \App\Models\Modelos::all();

    $modelo_id = $request->input('modelo_id');
    $desde = $request->input('desde');
    $hasta = $request->input('hasta');

    $query = \App\Models\Vehiculo::with(['modelo', 'marca']); // o 'modelo.marca' segun tu relación

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

    return view('poo', compact('vehiculos', 'modelos', 'modelo_id', 'desde', 'hasta'));
}
}