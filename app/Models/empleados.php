<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class empleados extends Model
{
    use HasFactory;
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'empleado_tarea', 'empleado_id', 'tarea_id');
    }
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'telefono',
        'estado_civil',
        'direccion',
        'email',
    ];
}
