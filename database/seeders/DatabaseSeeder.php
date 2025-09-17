<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TareaSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TareaSeeder::class);
    }
}
