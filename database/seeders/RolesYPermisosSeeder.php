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
            'crear vehiculos',
            'editar vehiculos',
            'eliminar vehiculos',

            //Clientes
            'ver clientes',
            'crear clientes',
            'editar clientes',
            'eliminar clientes',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // 2️⃣ Crear roles
        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolEmpleado = Role::firstOrCreate(['name' => 'empleado']);
        $rolSupervisor = Role::firstOrCreate(['name' => 'supervisor']);

        // 3️⃣ Asignar permisos a roles
        $rolAdmin->syncPermissions($permisos); // Admin tiene todos

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

        // 4️⃣ Crear usuarios y asignar roles
        $usuarios = [
            'admin@tudominio.com' => ['name' => 'Administrador', 'rol' => 'admin', 'password' => '123456'],
            'asd@hotmail.com' => ['name' => 'Otro Admin', 'rol' => 'admin', 'password' => '123456'],
            'empleado@tudominio.com' => ['name' => 'Empleado', 'rol' => 'empleado', 'password' => '123456'],
            'supervisor@tudominio.com' => ['name' => 'Supervisor', 'rol' => 'supervisor', 'password' => '123456'],
        ];

        foreach ($usuarios as $email => $info) {
            // Crear el usuario si no existe
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $info['name'], 'password' => bcrypt($info['password'])]
            );

            // Asignar rol, evita duplicados
            if (!$user->hasRole($info['rol'])) {
                $user->assignRole($info['rol']);
            }
        }

        // 5️⃣ Limpiar cache de Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('✅ Roles, permisos y usuarios creados correctamente.');
    }
}
