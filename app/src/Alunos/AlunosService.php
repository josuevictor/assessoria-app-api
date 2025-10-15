<?php

namespace App\src\Alunos;

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

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $record = Alunos::where('id', $id)->first();

        if (!$record) {
            return null;
        }

        // Chama o repository pra aplicar o update
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