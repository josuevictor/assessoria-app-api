<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treinos_realizados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treino_id')->constrained('treinos')->onDelete('cascade');
            $table->date('data_realizacao');
            $table->float('distancia_realizada_km')->nullable();
            $table->integer('tempo_realizado_min')->nullable();
            $table->float('ritmo_medio_min_km')->nullable();
            $table->integer('fc_media')->nullable();
            $table->integer('fc_max')->nullable();
            $table->tinyInteger('percepcao_esforco')->nullable(); // escala 1-10
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinos_realizados');
    }
};
