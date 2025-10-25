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
        Schema::create('eventos_corrida', function (Blueprint $table) {
            $table->id();
            $table->string('nome_evento');        
            $table->text('descricao')->nullable(); 
            $table->date('data_evento');          
            $table->time('hora_evento')->nullable(); 
            $table->float('distancia_km');
            $table->string('local')->nullable();
            $table->integer('vagas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_corrida');
    }
};
