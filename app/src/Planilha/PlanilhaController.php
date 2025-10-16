<?php

namespace App\src\Planilha;

use Illuminate\Http\Request;

class PlanilhaController
{
    protected $service;

    public function __construct(PlanilhaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return response()->json($this->service->getAll());
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao buscar registros', 'error' => $th->getMessage()], 500);
        }
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

        try {
            $planilha = $this->service->create($request->all());
            return response()->json($planilha, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar planilha',
                'error' => $th->getMessage()
            ], 500);
        }

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