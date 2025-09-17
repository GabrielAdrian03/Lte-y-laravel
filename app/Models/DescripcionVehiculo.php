<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescripcionVehiculo extends Model
{
    protected $table = 'descripciones_vehiculo';

    protected $fillable = [
        'vehiculo_id',
        'estado_general',
        'piezas_daniadas',
        'precio_servicio',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
