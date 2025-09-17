<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\DescripcionVehiculo;

class DescripcionVehiculoController extends Controller
{
    public function create($vehiculo_id)
    {
        $vehiculo = Vehiculo::findOrFail($vehiculo_id);
        return view('vehiculos.descripcion', compact('vehiculo'));
    }

    public function store(Request $request, $vehiculo_id)
    {
        $request->validate([
            'estado_general' => 'required|string|max:255',
            'piezas_daniadas' => 'required|string',
            'precio_servicio' => 'required|numeric|min:0',
        ]);

        DescripcionVehiculo::create([
            'vehiculo_id' => $vehiculo_id,
            'estado_general' => $request->estado_general,
            'piezas_daniadas' => $request->piezas_daniadas,
            'precio_servicio' => $request->precio_servicio,
        ]);

        return redirect()->route('vehiculos.descripcion.create', $vehiculo_id)->with('success', 'Descripción registrada correctamente.');
    }
}
