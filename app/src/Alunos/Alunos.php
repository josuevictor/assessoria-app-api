<?php

namespace App\src\Alunos;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Alunos extends Model
{
    protected $table = 'alunos';
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'matricula',
        'cpf',
        'data_nascimento',
        'sexo',
        'telefone',
        'cep',
        'endereco',
        'cidade',
        'estado',
        'ativo',
    ];


    // Define a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



