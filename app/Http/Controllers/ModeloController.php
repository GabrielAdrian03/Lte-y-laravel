<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function getModelos($marca_id)
    {
        $modelos = Modelo::where('marca_id', $marca_id)->get();
        return response()->json($modelos);
    }
}