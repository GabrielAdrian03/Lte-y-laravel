<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Vehiculo;
use App\Models\Modelo;

class AdminController extends Controller
{
    public function dashboard()
    {
        $clientes = Cliente::latest()->paginate(10);
        $empleados = Empleado::all();
        $vehiculos = Vehiculo::all();
        $modelos = Modelo::all();

        return view('admin.dashboard', compact('clientes', 'empleados', 'vehiculos', 'modelos'));
    }
}
