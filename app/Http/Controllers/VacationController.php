<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class VacationController extends Controller
{
    public function index()
{
    $vacaciones = \App\Models\Vacacion::where('user_id', auth()->id())->get();

    return view('vacaciones.index', compact('vacaciones'));
}

    public function store(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
    ]);

    $fechaInicio = \Carbon\Carbon::parse($request->fecha_inicio);
    $fechaFin = $fechaInicio->copy()->addWeeks(2);

    // Guardar en DB para el usuario actual
    $vacacion = \App\Models\Vacacion::create([
        'user_id' => auth()->id(),
        'fecha_inicio' => $fechaInicio,
        'fecha_fin' => $fechaFin,
    ]);
    // Redirigir con mensaje de éxito
    return redirect()
        ->route('vacaciones.index')
        ->with('success', 'Tus vacaciones fueron registradas con éxito.');
}
}