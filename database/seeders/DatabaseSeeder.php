<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TareaSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TareaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ModeloSeeder::class);
        $this->call(InformeSeeder::class);
        $this->call(RolesYPermisosSeeder::class);
}
}