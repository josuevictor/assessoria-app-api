<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciciosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('exercicios')->insert([
            [
                'treino_id' => 1,
                'nome' => 'Corrida leve em esteira',
                'series' => 1,
                'repeticoes' => null,
                'carga' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 2,
                'nome' => 'Tiro de 1000m',
                'series' => 4,
                'repeticoes' => 1,
                'carga' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 3,
                'nome' => 'Agachamento livre',
                'series' => 4,
                'repeticoes' => 10,
                'carga' => 60.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 3,
                'nome' => 'Prancha abdominal',
                'series' => 3,
                'repeticoes' => 1,
                'carga' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'treino_id' => 4,
                'nome' => 'Corrida contínua',
                'series' => 1,
                'repeticoes' => null,
                'carga' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
