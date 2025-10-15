<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventosCorridaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('eventos_corrida')->insert([
            [
                'user_id' => 1,
                'nome_evento' => 'Corrida da Cidade 5K',
                'data_evento' => now()->subMonths(3),
                'distancia_km' => 5.0,
                'tempo_final_min' => 27,
                'colocacao' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nome_evento' => 'Desafio 10K Primavera',
                'data_evento' => now()->subMonths(2),
                'distancia_km' => 10.0,
                'tempo_final_min' => 55,
                'colocacao' => 82,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nome_evento' => 'Night Run - Etapa Verão',
                'data_evento' => now()->subMonths(1),
                'distancia_km' => 7.5,
                'tempo_final_min' => 38,
                'colocacao' => 33,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nome_evento' => 'Corrida Solidária 5K',
                'data_evento' => now()->subDays(10),
                'distancia_km' => 5.0,
                'tempo_final_min' => 26,
                'colocacao' => 27,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
