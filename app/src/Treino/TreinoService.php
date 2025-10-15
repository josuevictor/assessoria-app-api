<?php

namespace App\src\Treino;

class TreinoService
{
    protected $repository;

    public function __construct(TreinoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($planilha_id)
    {
        return $this->repository->findByPlanilha($planilha_id);
    }

    public function create(array $data)
    {
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