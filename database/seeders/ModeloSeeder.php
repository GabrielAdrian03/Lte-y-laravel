<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modelos;

class ModeloSeeder extends Seeder
{

    public function run(): void
    {
        $modelos = [
            // Toyota
            ['nombreModelo' => 'Corolla', 'marca_id' => 1],
            ['nombreModelo' => 'Hilux', 'marca_id' => 1],
            ['nombreModelo' => 'Yaris', 'marca_id' => 1],

            // Ford
            ['nombreModelo' => 'Fiesta', 'marca_id' => 2],
            ['nombreModelo' => 'Focus', 'marca_id' => 2],
            ['nombreModelo' => 'Ranger', 'marca_id' => 2],

            // Chevrolet
            ['nombreModelo' => 'Onix', 'marca_id' => 3],
            ['nombreModelo' => 'Cruze', 'marca_id' => 3],
            ['nombreModelo' => 'S10', 'marca_id' => 3],

            // Volkswagen
            ['nombreModelo' => 'Gol', 'marca_id' => 4],
            ['nombreModelo' => 'Polo', 'marca_id' => 4],
            ['nombreModelo' => 'Amarok', 'marca_id' => 4],

            // Fiat
            ['nombreModelo' => 'Argo', 'marca_id' => 5],
            ['nombreModelo' => 'Cronos', 'marca_id' => 5],
            ['nombreModelo' => 'Toro', 'marca_id' => 5],

            // Peugeot
            ['nombreModelo' => '208', 'marca_id' => 6],
            ['nombreModelo' => '308', 'marca_id' => 6],
            ['nombreModelo' => 'Partner', 'marca_id' => 6],

            // Renault
            ['nombreModelo' => 'Clio', 'marca_id' => 7],
            ['nombreModelo' => 'Kangoo', 'marca_id' => 7],
            ['nombreModelo' => 'Sandero', 'marca_id' => 7],

            // Nissan
            ['nombreModelo' => 'Versa', 'marca_id' => 8],
            ['nombreModelo' => 'Frontier', 'marca_id' => 8],
            ['nombreModelo' => 'March', 'marca_id' => 8],

            // Mercedes-Benz
            ['nombreModelo' => 'Clase A', 'marca_id' => 9],
            ['nombreModelo' => 'Clase C', 'marca_id' => 9],
            ['nombreModelo' => 'Sprinter', 'marca_id' => 9],
        ];

        foreach ($modelos as $modelo) {
            Modelos::create($modelo);

    }
}
}

