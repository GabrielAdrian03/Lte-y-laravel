<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'apellido',
        'nombres',
        'dni',
        'direccion',
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

}