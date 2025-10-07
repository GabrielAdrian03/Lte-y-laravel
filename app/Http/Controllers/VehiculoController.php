<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Modelo;
use App\controllers\modeloController;

class VehiculoController extends Controller
{
    public function create()
    {
        $modelo = Modelo::all();
        $marcas = \App\Models\Marca::all();
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
