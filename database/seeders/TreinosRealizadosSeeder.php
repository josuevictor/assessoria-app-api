<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreinosRealizadosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('treinos_realizados')->insert([
            [
                'treino_id' => 1,
                'data_realizacao' => now()->subDays(10),
                'distancia_realizada_km' => 5.2,
                'tempo_realizado_min' => 30,
                'ritmo_medio_min_km' => 5.8,
                'fc_media' => 145,
                'fc_max' => 168,
                'percepcao_esforco' => 6,
                'observacoes' => 'Corrida leve, senti bom controle da respiração.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 2,
                'data_realizacao' => now()->subDays(8),
                'distancia_realizada_km' => 8.0,
                'tempo_realizado_min' => 42,
                'ritmo_medio_min_km' => 5.3,
                'fc_media' => 152,
                'fc_max' => 175,
                'percepcao_esforco' => 7,
                'observacoes' => 'Tiros bem executados, cansativo no final.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 3,
                'data_realizacao' => now()->subDays(6),
                'distancia_realizada_km' => null,
                'tempo_realizado_min' => 55,
                'ritmo_medio_min_km' => null,
                'fc_media' => 130,
                'fc_max' => 160,
                'percepcao_esforco' => 5,
                'observacoes' => 'Treino de força completo. Boa execução técnica.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 4,
                'data_realizacao' => now()->subDays(4),
                'distancia_realizada_km' => 14.6,
                'tempo_realizado_min' => 88,
                'ritmo_medio_min_km' => 6.0,
                'fc_media' => 148,
                'fc_max' => 172,
                'percepcao_esforco' => 8,
                'observacoes' => 'Longão exigente, calor forte durante o percurso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
