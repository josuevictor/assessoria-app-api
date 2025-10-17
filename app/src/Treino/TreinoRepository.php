<?php

namespace App\src\Treino;

class TreinoRepository
{
    protected $model;

    public function __construct(Treino $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
        ->with([
            'planilha.user:id,name' // traz o name do usuário
        ])
        ->get();
        
    }

    public function find($planilha_id)
    {
        return $this->model->find($planilha_id);
    }

    public function findByPlanilha($planilha_id)
    {
        return $this->model
            ->where('planilha_id', $planilha_id)
            ->orderBy('data_treino', 'asc')
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

    public function delete($id)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->delete();
            return true;
        }
        return false;
    }    
}