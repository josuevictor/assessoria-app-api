<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::table('eventos_corrida', function (Blueprint $table) {
    // remover colunas antigas
    if (Schema::hasColumn('eventos_corrida', 'user_id')) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    }
    if (Schema::hasColumn('eventos_corrida', 'tempo_final_min')) {
        $table->dropColumn('tempo_final_min');
    }
    if (Schema::hasColumn('eventos_corrida', 'colocacao')) {
        $table->dropColumn('colocacao');
    }

    // adicionar colunas novas
    if (!Schema::hasColumn('eventos_corrida', 'descricao')) {
        $table->text('descricao')->nullable()->after('nome_evento');
    }
    if (!Schema::hasColumn('eventos_corrida', 'hora_evento')) {
        $table->time('hora_evento')->nullable()->after('data_evento');
    }
    if (!Schema::hasColumn('eventos_corrida', 'local')) {
        $table->string('local')->nullable()->after('distancia_km');
    }
    if (!Schema::hasColumn('eventos_corrida', 'vagas')) {
        $table->integer('vagas')->nullable()->after('local');
    }
});

    }

    public function down(): void
    {
        Schema::table('eventos_corrida', function (Blueprint $table) {
            // desfazer alterações
            if (Schema::hasColumn('descricao')) $table->dropColumn('descricao');
            if (Schema::hasColumn('hora_evento')) $table->dropColumn('hora_evento');
            if (Schema::hasColumn('local')) $table->dropColumn('local');
            if (Schema::hasColumn('vagas')) $table->dropColumn('vagas');

            // adicionar colunas antigas de volta
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            $table->integer('tempo_final_min')->nullable()->after('distancia_km');
            $table->integer('colocacao')->nullable()->after('tempo_final_min');
        });
    }
};
