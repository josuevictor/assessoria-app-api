<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->string('tipo')->change(); // altera o tipo para string
        });
    }

    public function down(): void
    {
        Schema::table('treinos', function (Blueprint $table) {
            $table->enum('tipo', ['corrida', 'fortalecimento', 'intervalado', 'longao', 'rodagem'])->change();
        });
    }
};

