<?php

namespace App\src\AvaliacaoFisica;

use App\src\Alunos\Alunos;

class AvaliacaoFisicaRepository
{
    protected $model;

    public function __construct(AvaliacaoFisica $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByCpf($cpf)
    {
        return AvaliacaoFisica::join('alunos', 'avaliacoes_fisicas.user_id', '=', 'alunos.user_id')
            ->where('alunos.cpf', $cpf)
            ->select('avaliacoes_fisicas.*')
            ->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }
}