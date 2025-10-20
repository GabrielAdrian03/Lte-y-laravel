<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Asegura el nombre correcto de la tabla

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'telefono',
        'estado_civil',
        'direccion',
        'email',
        'vehiculo_id', // para asignar un vehículo específico
        'cliente_id',  // para asignar un cliente específico
    ];

    /**
     * 🔹 Relación muchos a muchos con tareas
     */
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'empleado_tarea', 'empleado_id', 'tarea_id');
    }

    /**
     * 🔹 Relación uno a muchos: un empleado puede tener varios vehículos
     *    Compatible con funciones antiguas que usan $empleado->vehiculos
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'empleado_id');
    }

    /**
     * 🔹 Vehículo asignado actualmente (uno a uno)
     *    Para la vista y asignación de un solo vehículo
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    /**
     * 🔹 Relación uno a muchos: un empleado puede atender a varios clientes
     *    Compatible con funciones antiguas que usan $empleado->clientes
     */
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empleado_id');
    }

    /**
     * 🔹 Cliente asignado actualmente (uno a uno)
     *    Para la vista y asignación de un solo cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
