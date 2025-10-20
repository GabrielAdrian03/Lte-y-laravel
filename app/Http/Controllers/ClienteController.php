<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
public function index()
{
    $clientes = Cliente::latest()->paginate(10);
    return view('clientes.index', compact('clientes'));
}

public function create()
{
    return view('clientes.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'apellido'  => 'required|string|max:255',
        'nombres'   => 'required|string|max:255',
        'dni'       => 'required|string|max:50|unique:clientes,dni',
        'direccion' => 'nullable|string|max:255',
    ]);

    Cliente::create($data);

    return redirect()->route('poo')->with('success', 'Cliente registrado correctamente.');
}
}