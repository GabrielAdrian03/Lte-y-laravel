<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    public function empleados()
    {
        return $this->belongsToMany(empleados::class, 'empleado_tarea', 'tarea_id', 'empleado_id');
    }
    use HasFactory;

    protected $fillable = ['nombre'];
}