<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelos;


class ModeloController extends Controller
{
    public function getModelos($marca_id)
    {
        $modelos = Modelos::where('marca_id', $marca_id)->get(['id', 'nombreModelo']);
        return response()->json($modelos);
    }
}