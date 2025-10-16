<?php

namespace App\src\Planilha;

use App\src\Alunos\Alunos;
use Illuminate\Support\Facades\Validator;

class PlanilhaService
{
    protected $repository;

    public function __construct(PlanilhaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {

        try {
            
            $validator = Validator::make($data,[
                'cpf' => 'required|string|size:14',
                'data_inicio' => 'required|date',
                'data_fim' => 'date|after_or_equal:data_inicio',
                'descricao' => 'nullable|string|max:500',
            ]);

            $validator->validate();

            $aluno = Alunos::where('cpf', $data['cpf'])->first();
            if (!$aluno) {
                throw new \Exception('Aluno com CPF informado não encontrado');
            }

            $data['user_id'] = $aluno->user_id;
            unset($data['cpf']);

            return $this->repository->create($data);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao criar registro', 'error' => $th->getMessage()], 500);
        }


        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}