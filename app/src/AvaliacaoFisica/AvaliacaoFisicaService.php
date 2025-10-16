<?php

namespace App\src\AvaliacaoFisica;

use Illuminate\Support\Facades\Validator;
use App\src\Alunos\Alunos;

class AvaliacaoFisicaService
{
    protected $repository;

    public function __construct(AvaliacaoFisicaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getByCpf($cpf)
    {
        return $this->repository->findByCpf($cpf);
    }

    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'cpf' => 'required|string|size:14',
            'data_avaliacao' => 'required|date',
            'peso' => 'required|numeric|min:0|max:500',
            'percentual_gordura' => 'nullable|numeric|min:0|max:100',
            'vo2max' => 'nullable|numeric|min:0|max:100',
            'massa_magra' => 'nullable|numeric|min:0|max:300',
            'massa_gorda' => 'nullable|numeric|min:0|max:300',
            'imc' => 'nullable|numeric|min:0|max:100',
            'frequencia_cardiaca_repouso' => 'nullable|integer|min:20|max:200',
            'circunferencia_abdomen' => 'nullable|numeric|min:0|max:300',
            'observacoes' => 'nullable|string|max:500',
        ]);

        $validator->validate();

        $aluno = Alunos::where('cpf', $data['cpf'])->first();
        if (!$aluno) {
            throw new \Exception('Aluno com CPF informado não encontrado');
        }

        $data['user_id'] = $aluno->user_id;
        unset($data['cpf']);

        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }
}
