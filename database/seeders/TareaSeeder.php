<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea; 

class TareaSeeder extends Seeder
{
    public function run()
    {
        Tarea::create(['nombre' => 'Instalación']);
        Tarea::create(['nombre' => 'Service']);
        Tarea::create(['nombre' => 'Reconexión']);
        Tarea::create(['nombre' => 'Desconexión']);
    }
}

