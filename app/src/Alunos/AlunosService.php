<?php

namespace App\src\Alunos;

use App\Models\User;
use Illuminate\Http\Request;

class AlunosService
{
    protected $repository;

    public function __construct(AlunosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($cpf)
    {
        return $this->repository->find($cpf);
    }

    public function criarAluno(Request $request)
    {
        //Validação
        $validated = $request->validate([
            'user_email' => 'required|email|exists:users,email',
            'cpf' => 'nullable|string|max:14',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:15',
            'cep' => 'nullable|string|max:9',
            'endereco' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:2',
        ]);

        //Busca o usuário
        $user = User::where('email', $validated['user_email'])->first();
        $validated['user_id'] = $user->id;
        unset($validated['user_email']);

        //Gera matrícula automática
        $lastAluno = Alunos::latest('id')->first();
        $nextNumber = $lastAluno ? $lastAluno->id + 1 : 1;
        $validated['matricula'] = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        //Cria o aluno
        return $this->repository->create($validated);
    }

    public function update($id, array $data)
    {
        $record = Alunos::where('id', $id)->first();

        if (!$record) {
            return null;
        }

        return $this->repository->update($record->id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function ativar($id)
    {
        return $this->repository->ativar($id);
    }
}
