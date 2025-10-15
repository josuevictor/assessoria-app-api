<?php

namespace App\src\Planilha;

use Illuminate\Database\Eloquent\Model;

class Planilha extends Model
{
    protected $table = 'planilhas';

    protected $fillable = [
        'user_id',
        'data_inicio',
        'data_fim',
        'descricao',
    ];

    protected $guarded = [];
}