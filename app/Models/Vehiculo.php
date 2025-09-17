<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'patente',
        'modelo',
        'fecha_vtv',
        'estado',
        'fecha_cambio_neumaticos',
        'cantidad_puertas',
        'anio',
    ];
}
