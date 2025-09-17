<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class FalloVehiculoController extends Controller
{
    public function store(Request $request, $vehiculo)
    {
        $request->validate([
            'descripcion_fallo' => 'required|string|max:255',
        ]);

        $vehiculo = Vehiculo::findOrFail($vehiculo);
        $vehiculo->descripcion_fallo = $request->descripcion_fallo;
        $vehiculo->save();

        return back()->with('success', 'Fallo registrado correctamente.');
    }
}