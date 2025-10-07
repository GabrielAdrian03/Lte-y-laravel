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
        // 1️⃣ Crear permisos del sistema
        $permisos = [
            // Tareas
            'ver tareas',
            'crear tareas',
            'editar tareas',
            'eliminar tareas',

            // Empleados
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'eliminar empleados',

            // Vacaciones
            'ver vacaciones',
            'gestionar vacaciones',

            // Vehículos
            'ver vehiculos',
            'gestionar vehiculos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // 2️⃣ Crear roles
        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolEmpleado = Role::firstOrCreate(['name' => 'empleado']);
        $rolSupervisor = Role::firstOrCreate(['name' => 'supervisor']);

        // 3️⃣ Asignar permisos a roles
        $rolAdmin->syncPermissions($permisos); // Admin tiene todo

        $rolSupervisor->syncPermissions([
            'ver tareas',
            'editar tareas',
            'ver empleados',
            'ver vehiculos',
            'gestionar vehiculos',
        ]);

        $rolEmpleado->syncPermissions([
            'ver tareas',
            'ver vacaciones',
        ]);

        // 4️⃣ Asignar roles a usuarios específicos por email
        $usuarios = [
            'admin@tudominio.com' => 'admin',
            'asd@hotmail.com' => 'admin',     // 🔹 tu usuario admin real
            'empleado@tudominio.com' => 'empleado',
            'supervisor@tudominio.com' => 'supervisor',
        ];

        foreach ($usuarios as $email => $rol) {
            $user = User::where('email', $email)->first();
            if ($user && !$user->hasRole($rol)) {
                $user->assignRole($rol);
            }
        }

        $this->command->info('✅ Roles y permisos creados y asignados correctamente.');
    }
}
