<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
{
    $marca = \App\Models\Marca::where('user_id', auth()->id())->get();

    return view('vacaciones.index', compact('vacaciones'));
}
}