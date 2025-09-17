<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function create()
    {
        return view('vehiculos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|string|max:20|unique:vehiculos,patente',
            'modelo' => 'required|string|max:255',
            'fecha_vtv' => 'required|date',
            'estado' => 'required|string|max:50',
            'fecha_cambio_neumaticos' => 'required|date',
            'cantidad_puertas' => 'required|integer|min:1',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.create')->with('success', 'Vehículo registrado correctamente.');
    }
}
