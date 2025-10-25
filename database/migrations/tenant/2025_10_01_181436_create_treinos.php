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
        Schema::create('treinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planilha_id')->constrained('planilhas')->onDelete('cascade');
            $table->date('data_treino');
            $table->enum('tipo', ['corrida', 'fortalecimento', 'intervalado', 'longao', 'rodagem']);
            $table->float('distancia_prevista_km')->nullable();
            $table->integer('tempo_previsto_min')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinos');
    }
};
