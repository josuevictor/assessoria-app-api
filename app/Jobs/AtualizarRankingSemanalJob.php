<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AtualizarRankingSemanalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Semana atual (segunda a domingo)
        $inicioSemana = Carbon::now()->startOfWeek();
        $fimSemana = Carbon::now()->endOfWeek();

        // Soma das distâncias por usuário dentro da semana
        $distancias = DB::table('atividades_strava')
            ->select('user_id', DB::raw('SUM(distancia_km) as total_km'))
            ->whereBetween('data_atividade', [$inicioSemana, $fimSemana])
            ->groupBy('user_id')
            ->orderByDesc('total_km')
            ->get();

        $posicao = 1;

        foreach ($distancias as $atividade) {
            // Regra de pontuação: 1 km = 10 pontos (ajustável)
            $pontos = round($atividade->total_km * 10);

            DB::table('ranking')->updateOrInsert(
                ['user_id' => $atividade->user_id],
                [
                    'pontos' => $pontos,
                    'posicao' => $posicao,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $posicao++;
        }

        // Caso algum usuário não tenha atividades na semana, zera os pontos
        $usuariosAtivos = $distancias->pluck('user_id')->toArray();

        DB::table('ranking')
            ->whereNotIn('user_id', $usuariosAtivos)
            ->update([
                'pontos' => 0,
                'posicao' => null,
                'updated_at' => now(),
            ]);
    }
}
