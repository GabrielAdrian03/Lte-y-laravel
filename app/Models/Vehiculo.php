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
    // Relación a través del modelo (modelo tiene marca_id)
    return $this->hasOneThrough(
        \App\Models\Marca::class,   // Modelo final (marca)
        \App\Models\Modelos::class,  // Modelo intermedio
        'id',                        // Clave local en modelos (id del modelo)
        'id',                        // Clave local en marcas (id de la marca)
        'modelo_id',                 // Clave en vehiculos que apunta al modelo
        'marca_id'                   // Clave en modelos que apunta a la marca
    );
}

    public function modelo()
    {
        return $this->belongsTo(Modelos::class, 'modelo_id');
    }
}
