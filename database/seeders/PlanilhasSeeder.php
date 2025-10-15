<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanilhasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('planilhas')->insert([
            [
                'user_id' => 1,
                'data_inicio' => Carbon::now()->subDays(45),
                'data_fim' => Carbon::now()->subDays(15),
                'descricao' => 'Treino de resistência para corrida de 10km',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'data_inicio' => Carbon::now()->subDays(20),
                'data_fim' => null,
                'descricao' => 'Plano de treino funcional e força geral',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
