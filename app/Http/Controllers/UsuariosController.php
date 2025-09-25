<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
     public function index()
{
    $vacaciones = \App\Models\Vacacion::where('user_id', auth()->id())->get();

    return view('vacaciones.index', compact('vacaciones'));
}

    public function store(Request $request)
{
    // Guardar en DB para el usuario actual
    $vacacion = \App\Models\usuarios::create([
        'usuario' => auth()->id(),
        'email' => $email,
        'contraseña' => $contraseña,
    ]);
    // Redirigir con mensaje de éxito
    return redirect()
        ->route('vacaciones.index')
        ->with('success', 'Tus vacaciones fueron registradas con éxito.');
}
}
