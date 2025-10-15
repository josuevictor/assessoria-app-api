<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TreinosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('treinos')->insert([
            [
                'planilha_id' => 1,
                'data_treino' => Carbon::now()->subDays(14),
                'tipo' => 'corrida',
                'distancia_prevista_km' => 5.0,
                'tempo_previsto_min' => 30,
                'observacoes' => 'Corrida leve de recuperação após treino longo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'planilha_id' => 1,
                'data_treino' => Carbon::now()->subDays(12),
                'tipo' => 'intervalado',
                'distancia_prevista_km' => 8.0,
                'tempo_previsto_min' => 45,
                'observacoes' => '4x1000m em ritmo moderado com 400m de descanso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'planilha_id' => 2,
                'data_treino' => Carbon::now()->subDays(6),
                'tipo' => 'fortalecimento',
                'distancia_prevista_km' => null,
                'tempo_previsto_min' => 60,
                'observacoes' => 'Treino de força com foco em quadríceps e core.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'planilha_id' => 2,
                'data_treino' => Carbon::now()->subDays(3),
                'tipo' => 'rodagem',
                'distancia_prevista_km' => 7.0,
                'tempo_previsto_min' => 40,
                'observacoes' => 'Rodagem leve em terreno plano.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
