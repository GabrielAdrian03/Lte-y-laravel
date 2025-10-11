<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Modelos;
use App\controllers\modeloController;
use App\Models\Marca;

class VehiculoController extends Controller
{
    public function create()
    {
        $modelos = Modelos::all();
        $marcas = Marca::all();
        return view('vehiculos.create', compact('marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|string|max:20|unique:vehiculos,patente',
            'marca_id' => 'required|string|max:255',
            'modelo_id' => 'required|string|max:255',
            'fecha_vtv' => 'required|date',
            'estado' => 'required|string|max:50',
            'fecha_cambio_neumaticos' => 'required|date',
            'cantidad_puertas' => 'required|integer|min:1',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('tareas.index')->with('success', 'Vehículo registrado correctamente.');
    }
    
}
