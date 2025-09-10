<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreModelo',
        'anioModelo',
        'marca',
        'fabricante',
        'fecha',
        'estado',
        'neumaticos',
    ];
}
