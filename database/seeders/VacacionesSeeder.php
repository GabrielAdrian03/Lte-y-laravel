<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vacacion;
use Carbon\Carbon;

class VacacionesSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Usa el primer usuario (o crea uno si no existe)

        if ($user) {
            Vacacion::create([
                'user_id' => $user->id,
                'fecha_inicio' => Carbon::now()->toDateString(),
                'fecha_fin' => Carbon::now()->addWeeks(2)->toDateString(),
            ]);
        }
    }
}
