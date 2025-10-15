<?php

namespace App\src\AvaliacaoFisica;

use App\src\Alunos\Alunos;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoFisica extends Model
{
    protected $table = 'avaliacoes_fisicas';
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'data_avaliacao',
        'peso',
        'percentual_gordura',
        'vo2max',
        'massa_magra',
        'massa_gorda',
        'imc',
        'frequencia_cardiaca_repouso',
        'circunferencia_abdomen',
        'observacoes'
    ];

    // Relação com o model Alunos
    public function aluno()
    {
        return $this->belongsTo(Alunos::class, 'user_id', 'user_id');
    }

}