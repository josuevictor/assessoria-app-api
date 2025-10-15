<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AvaliacoesFisicasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('avaliacoes_fisicas')->insert([
            [
                'user_id' => 1,
                'data_avaliacao' => Carbon::now()->subDays(30),
                'peso' => 78.5,
                'percentual_gordura' => 18.2,
                'vo2max' => 46.5,
                'observacoes' => 'Boa evolução no último mês, redução de gordura e aumento de VO2máx.',
                'imc' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'data_avaliacao' => Carbon::now()->subDays(15),
                'peso' => 92.3,
                'percentual_gordura' => 24.7,
                'vo2max' => 39.8,
                'observacoes' => 'Leve melhora no condicionamento aeróbico, recomendada continuidade do treino intervalado.',
                'imc' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
