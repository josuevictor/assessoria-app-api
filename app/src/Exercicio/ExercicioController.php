<?php

namespace App\src\Exercicio;

use Illuminate\Http\Request;

class ExercicioController
{
    protected $service;

    public function __construct(ExercicioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        $atividade = $this->service->getById($id);
        if (!$atividade) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        return response()->json($atividade);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $atividade = $this->service->create($data);
        return response()->json($atividade, 201);
    }

    public function update(Request $request, $id)
    {
        $atividade = $this->service->update($id, $request->all());
        if (!$atividade) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        return response()->json($atividade);
    }

    public function destroy($id)
    {
        if ($this->service->delete($id)) {
            return response()->json(['message' => 'Registro deletado com sucesso']);
        }
        return response()->json(['message' => 'Registro não encontrado'], 404);
    }
}