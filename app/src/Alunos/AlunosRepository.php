<?php

namespace App\src\Alunos;


class AlunosRepository
{
    protected $model;

    public function __construct(Alunos $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($cpf)
    {
        return $this->model->find($cpf);
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

    //Inativa o aluno e o usuário vinculado
    public function delete($id)
    {
        $record = $this->model->find($id);

        if ($record) {
            $record->ativo = false;
            $record->save();

            if ($record->user) {
                $record->user->ativo = false;
                $record->user->save();
            }

            return true;
        }

        return false;
    }

    //Ativa o aluno e o usuário vinculado
    public function ativar($id)
    {
        $record = $this->model->find($id);

        if ($record) {
            $record->ativo = true;
            $record->save();

            if ($record->user) {
                $record->user->ativo = true;
                $record->user->save();
            }

            return true;
        }

        return false;
    }

}