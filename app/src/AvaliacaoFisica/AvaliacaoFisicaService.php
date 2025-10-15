<?php

namespace App\src\AvaliacaoFisica;


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
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }
}