<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AtividadesStravaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('atividades_strava')->insert([
            [
                'user_id' => 1,
                'strava_activity_id' => Str::uuid(),
                'nome' => 'Corrida Matinal',
                'distancia_km' => 5.2,
                'tempo_min' => 28,
                'ritmo_medio_min_km' => 5.38,
                'data_atividade' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'strava_activity_id' => Str::uuid(),
                'nome' => 'Treino Longo de Domingo',
                'distancia_km' => 12.4,
                'tempo_min' => 70,
                'ritmo_medio_min_km' => 5.64,
                'data_atividade' => now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'strava_activity_id' => Str::uuid(),
                'nome' => 'Pedalada Noturna',
                'distancia_km' => 25.8,
                'tempo_min' => 62,
                'ritmo_medio_min_km' => 2.4,
                'data_atividade' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
