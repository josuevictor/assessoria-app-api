<?php

namespace App\src\Treino;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\src\Planilha\Planilha;

class Treino extends Model
{
    protected $table = 'treinos';
    protected $guarded = [];

    // Relação com o modelo Aluno
    public function planilha()
    {
        return $this->belongsTo(Planilha::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}