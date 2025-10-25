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
        Schema::create('avaliacoes_fisicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('data_avaliacao');
            $table->float('peso');
            $table->float('percentual_gordura')->nullable();
            $table->float('vo2max')->nullable();

            //Dados complementares
            $table->decimal('massa_magra', 5, 2)->nullable();
            $table->decimal('massa_gorda', 5, 2)->nullable();
            $table->decimal('imc', 5, 2);
            $table->integer('frequencia_cardiaca_repouso')->nullable();
            $table->decimal('circunferencia_abdomen', 5, 2)->nullable();

            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_fisicas');
    }
};
