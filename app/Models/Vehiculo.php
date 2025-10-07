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
        'marca_id',
        'modelo_id',
        'fecha_vtv',
        'estado',
        'fecha_cambio_neumaticos',
        'cantidad_puertas',
        'anio',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
