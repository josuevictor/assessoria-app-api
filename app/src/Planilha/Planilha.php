<?php

namespace App\src\Planilha;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    // Define a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}