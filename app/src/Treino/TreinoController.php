<?php

namespace App\src\Treino;

use Illuminate\Http\Request;

class TreinoController
{
    protected $service;

    public function __construct(TreinoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($planilha_id)
    {
        $treino = $this->service->getById($planilha_id);
        if (!$treino) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        return response()->json($treino);
    }

    public function store(Request $request)
    {
        //$data = $request->all();

        $validated = $request->validate([
            'cpf' => 'required|string|size:14',
            'data_treino' => 'required|date',
            'dia_semana' => 'required|string|max:50',
            'tipo' => 'required|string|max:255',
            'distancia_prevista_km' => 'nullable|numeric',
            'tempo_previsto_min' => 'nullable|integer',
            'observacoes' => 'nullable|string|max:1000',
            'planilha_id' => 'required|integer|exists:planilhas,id',
        ]);

        $cpf = $validated['cpf'];
        $planilha_id = $validated['planilha_id'];
        unset($validated['cpf']);

        $aluno = \App\src\Alunos\Alunos::where('cpf', $cpf)->first();
        $user_id = $aluno['user_id'] ?? null;
        if (!$user_id) {
            return response()->json(['message' => 'Aluno com CPF informado não encontrado'], 404);
        }

        $planilha = \App\src\Planilha\Planilha::where('user_id', $user_id)->first();
        $planilha_id = $planilha['id'] ?? null;
        
        if (!$planilha_id) {
            return response()->json(['message' => 'Planilha para o aluno com CPF informado não encontrada'], 404);
        }

        $planilha = \App\src\Planilha\Planilha::where('id', $planilha_id)->where('user_id', $aluno->user_id)->first();
        if (!$planilha) {
            return response()->json(['message' => 'Planilha selecionada não pertence ao aluno informado'], 404);
        }

        $validated['planilha_id'] = $planilha_id;
        unset($validated['cpf']);

        $treino = $this->service->create($validated);
        return response()->json($treino, 201);
    }

    public function update(Request $request, $id)
    {
        $treino = $this->service->update($id, $request->all());
        if (!$treino) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        return response()->json($treino);
    }

    public function destroy($id)
    {
        if ($this->service->delete($id)) {
            return response()->json(['message' => 'Registro deletado com sucesso']);
        }
        return response()->json(['message' => 'Registro não encontrado'], 404);
    }
}
