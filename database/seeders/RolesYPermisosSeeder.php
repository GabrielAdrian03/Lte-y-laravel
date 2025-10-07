<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Crear permisos
        $permisos = ['ver articulos', 'editar articulos', 'borrar articulos'];
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear rol
        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);

        // Asignar permisos al rol
        $rolAdmin->syncPermissions($permisos);

        // Asignar rol a un usuario
        $user = User::first(); // O User::find(1)
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
