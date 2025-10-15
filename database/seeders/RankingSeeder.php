<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ranking')->insert([
            [
                'user_id' => 1,
                'pontos' => 120,
                'posicao' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'pontos' => 95,
                'posicao' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
