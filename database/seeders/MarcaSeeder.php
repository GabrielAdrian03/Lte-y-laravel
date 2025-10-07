<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;
use App\Models\Modelo;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $marcas = [
            'Toyota', 'Ford', 'Chevrolet', 'Volkswagen',
            'Fiat', 'Peugeot', 'Renault', 'Nissan', 'Mercedes-Benz'
        ];

        foreach ($marcas as $nombre) {
            Marca::create(['nombre' => $nombre]);


    }
}
}
