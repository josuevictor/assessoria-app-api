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
            
            $validated = $request->validate([
                'cpf' => 'required|string|size:14',
                'data_inicio' => 'required|date',
                'data_fim' => 'date|after_or_equal:data_inicio',
                'descricao' => 'nullable|string|max:500',
            ]);

            $cpf = $validated['cpf'];
            unset($validated['cpf']);

            $aluno = \App\src\Alunos\Alunos::where('cpf', $cpf)->first();
            $user_id = $aluno['user_id'] ?? null;
            if (!$user_id) {
                return response()->json(['message' => 'Aluno com CPF informado não encontrado'], 404);
            }

            $validated['user_id'] = $user_id;
            unset($validated['cpf']);

            $planilha = $this->service->create($validated);
            return response()->json($planilha, 201);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao criar registro', 'error' => $th->getMessage()], 500);
        }
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